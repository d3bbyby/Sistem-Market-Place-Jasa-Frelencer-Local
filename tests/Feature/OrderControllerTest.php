<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_create_order_at_the_current_service_price(): void
    {
        $client = User::factory()->create(['role' => 'client']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer);

        $response = $this->actingAs($client)->post(route('client.orders.store', $service), [
            'total_price' => 1,
        ]);

        $response->assertRedirect(route('client.orders.index'));
        $order = Order::query()->sole();
        $this->assertSame($client->id, $order->client_id);
        $this->assertSame($service->id, $order->service_id);
        $this->assertSame(1500000.0, (float) $order->total_price);
        $this->assertSame('MENUNGGU', $order->status);

        $this->get(route('client.orders.index'))
            ->assertSee('Landing Page')
            ->assertSee('MENUNGGU');
    }

    public function test_client_cannot_order_their_own_service(): void
    {
        $client = User::factory()->create(['role' => 'client']);
        $service = $this->createService($client);

        $response = $this->actingAs($client)->post(route('client.orders.store', $service));

        $response->assertForbidden();
        $this->assertDatabaseCount('orders', 0);
    }

    public function test_service_search_displays_services_matching_the_search_term(): void
    {
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer);

        $response = $this->get('/client/jasa?q=Landing');

        $response->assertSee($service->title)
            ->assertSee('Detail dan Pesan');
    }

    public function test_client_can_view_the_selected_service_details(): void
    {
        $client = User::factory()->create(['role' => 'client']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer);

        $response = $this->actingAs($client)->get(route('client.orders.service', $service));

        $response->assertSee($service->title)
            ->assertSee($service->description)
            ->assertSee($freelancer->name);
    }

    public function test_freelancer_can_process_an_order_for_their_service(): void
    {
        $client = User::factory()->create(['role' => 'client']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer);
        $order = Order::create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'status' => 'MENUNGGU',
        ]);

        $response = $this->actingAs($freelancer)->patch(route('freelancer.orders.updateStatus', $order), [
            'status' => 'DIPROSES',
        ]);

        $response->assertRedirect();
        $this->assertSame('DIPROSES', $order->refresh()->status);

        $this->get(route('freelancer.orders.index'))
            ->assertSee('Landing Page')
            ->assertSee('DIPROSES');
    }

    public function test_freelancer_must_attach_a_file_before_submitting_an_order(): void
    {
        $client = User::factory()->create(['role' => 'client']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer);
        $order = Order::create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'status' => 'DIPROSES',
        ]);

        $response = $this->actingAs($freelancer)
            ->from(route('freelancer.orders.index'))
            ->patch(route('freelancer.orders.updateStatus', $order), ['status' => 'SUBMITTED']);

        $response->assertSessionHasErrors('work_result_file');
        $this->assertSame('DIPROSES', $order->refresh()->status);
        $this->assertNull($order->work_result_file);
    }

    public function test_freelancer_can_submit_an_order_with_a_valid_deliverable(): void
    {
        Storage::fake('local');
        $client = User::factory()->create(['role' => 'client']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer);
        $order = Order::create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'status' => 'DIPROSES',
        ]);

        $response = $this->actingAs($freelancer)->patch(route('freelancer.orders.updateStatus', $order), [
            'status' => 'SUBMITTED',
            'work_result_file' => UploadedFile::fake()->create('hasil.pdf', 100, 'application/pdf'),
        ]);

        $response->assertRedirect();
        $order->refresh();
        $this->assertSame('SUBMITTED', $order->status);
        $this->assertNotNull($order->work_result_file);
        Storage::disk('local')->assertExists($order->work_result_file);
    }

    public function test_freelancer_cannot_submit_an_executable_as_a_deliverable(): void
    {
        Storage::fake('local');
        $client = User::factory()->create(['role' => 'client']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer);
        $order = Order::create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'status' => 'DIPROSES',
        ]);

        $response = $this->actingAs($freelancer)
            ->from(route('freelancer.orders.index'))
            ->patch(route('freelancer.orders.updateStatus', $order), [
                'status' => 'SUBMITTED',
                'work_result_file' => UploadedFile::fake()->create('program.exe', 100, 'application/octet-stream'),
            ]);

        $response->assertSessionHasErrors('work_result_file');
        $this->assertSame('DIPROSES', $order->refresh()->status);
        $this->assertNull($order->work_result_file);
    }

    public function test_client_must_provide_revision_notes_when_requesting_a_revision(): void
    {
        $client = User::factory()->create(['role' => 'client']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer);
        $order = Order::create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'status' => 'SUBMITTED',
        ]);

        $response = $this->actingAs($client)
            ->from(route('client.orders.index'))
            ->patch(route('client.orders.updateStatus', $order), ['status' => 'REVISI']);

        $response->assertSessionHasErrors('revision_notes');
        $this->assertSame('SUBMITTED', $order->refresh()->status);
    }

    public function test_client_can_request_a_revision_with_notes(): void
    {
        $client = User::factory()->create(['role' => 'client']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer);
        $order = Order::create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'status' => 'SUBMITTED',
        ]);

        $response = $this->actingAs($client)->patch(route('client.orders.updateStatus', $order), [
            'status' => 'REVISI',
            'revision_notes' => 'Mohon sesuaikan warna tombol.',
        ]);

        $response->assertRedirect();
        $order->refresh();
        $this->assertSame('REVISI', $order->status);
        $this->assertSame('Mohon sesuaikan warna tombol.', $order->revision_notes);
    }

    public function test_client_can_complete_an_order_after_reviewing_the_submission(): void
    {
        $client = User::factory()->create(['role' => 'client']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer);
        $order = Order::create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'status' => 'SUBMITTED',
        ]);

        $response = $this->actingAs($client)->patch(route('client.orders.updateStatus', $order), [
            'status' => 'SELESAI',
        ]);

        $response->assertRedirect();
        $this->assertSame('SELESAI', $order->refresh()->status);
    }

    public function test_order_deliverable_can_be_downloaded_by_its_client(): void
    {
        Storage::fake('local');
        $client = User::factory()->create(['role' => 'client']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer);
        $filePath = UploadedFile::fake()->create('hasil.pdf', 100, 'application/pdf')
            ->store('order-deliverables', 'local');
        $order = Order::create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'status' => 'SUBMITTED',
            'work_result_file' => $filePath,
        ]);

        $response = $this->actingAs($client)->get(route('orders.deliverable', $order));

        $response->assertDownload('hasil-pesanan-'.$order->id.'.pdf');
    }

    public function test_other_users_cannot_download_an_order_deliverable(): void
    {
        Storage::fake('local');
        $client = User::factory()->create(['role' => 'client']);
        $otherClient = User::factory()->create(['role' => 'client']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer);
        $filePath = UploadedFile::fake()->create('hasil.pdf', 100, 'application/pdf')
            ->store('order-deliverables', 'local');
        $order = Order::create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'status' => 'SUBMITTED',
            'work_result_file' => $filePath,
        ]);

        $response = $this->actingAs($otherClient)->get(route('orders.deliverable', $order));

        $response->assertNotFound();
    }

    public function test_freelancer_cannot_update_an_order_for_another_freelancer(): void
    {
        $client = User::factory()->create(['role' => 'client']);
        $serviceOwner = User::factory()->create(['role' => 'freelancer']);
        $otherFreelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($serviceOwner);
        $order = Order::create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'status' => 'MENUNGGU',
        ]);

        $response = $this->actingAs($otherFreelancer)->patch(route('freelancer.orders.updateStatus', $order), [
            'status' => 'DIPROSES',
        ]);

        $response->assertForbidden();
        $this->assertSame('MENUNGGU', $order->refresh()->status);
    }

    public function test_client_cannot_complete_an_order_before_the_freelancer_submits_it(): void
    {
        $client = User::factory()->create(['role' => 'client']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer);
        $order = Order::create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'status' => 'MENUNGGU',
        ]);

        $response = $this->actingAs($client)->patch(route('client.orders.updateStatus', $order), [
            'status' => 'SELESAI',
        ]);

        $response->assertForbidden();
        $this->assertSame('MENUNGGU', $order->refresh()->status);
    }

    public function test_admin_can_update_a_freelancer_verification_status(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);

        $this->actingAs($admin)
            ->get(route('admin.freelancers.index'))
            ->assertSee($freelancer->name)
            ->assertSee('pending');

        $response = $this->actingAs($admin)->patch(
            route('admin.freelancers.updateVerification', $freelancer),
            ['verification_status' => 'verified'],
        );

        $response->assertRedirect();
        $this->assertSame('verified', $freelancer->refresh()->verification_status);
    }

    public function test_admin_can_update_order_status(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $client = User::factory()->create(['role' => 'client']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer);
        $order = Order::create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'status' => 'MENUNGGU',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.orders.index'))
            ->assertSee($service->title)
            ->assertSee($client->name)
            ->assertSee($freelancer->name);

        $response = $this->actingAs($admin)->patch(route('admin.orders.updateStatus', $order), [
            'status' => 'SELESAI',
        ]);

        $response->assertRedirect();
        $this->assertSame('SELESAI', $order->refresh()->status);
    }

    public function test_guest_is_redirected_to_login_from_the_client_order_list(): void
    {
        $response = $this->get(route('client.orders.index'));

        $response->assertRedirect('/login');
    }

    private function createService(User $freelancer): Service
    {
        $category = Category::create([
            'category_name' => 'Web Design',
            'slug' => 'web-design',
        ]);

        return Service::create([
            'freelancer_id' => $freelancer->id,
            'category_id' => $category->id,
            'title' => 'Landing Page',
            'description' => 'Pembuatan landing page responsif.',
            'price' => 1500000,
        ]);
    }
}
