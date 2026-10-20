<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JasaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_service_with_existing_orders_cannot_be_deleted_and_displays_reason(): void
    {
        $service = $this->createService();
        $client = User::factory()->create(['role' => 'client']);
        $message = 'Jasa tidak dapat dihapus karena sudah memiliki pesanan.';

        Order::create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'status' => 'MENUNGGU',
        ]);

        $response = $this->delete(route('jasa.destroy', $service));

        $response->assertRedirect(route('jasa.index'))
            ->assertSessionHas('error', $message);
        $this->assertModelExists($service);
        $this->assertDatabaseHas('orders', [
            'client_id' => $client->id,
            'service_id' => $service->id,
        ]);

        $this->get(route('jasa.index'))->assertSee($message);
    }

    public function test_service_without_orders_can_be_deleted(): void
    {
        $service = $this->createService();

        $response = $this->delete(route('jasa.destroy', $service));

        $response->assertRedirect(route('jasa.index'))
            ->assertSessionHas('success', 'Jasa berhasil dihapus!');
        $this->assertModelMissing($service);
    }

    private function createService(): Service
    {
        $freelancer = User::factory()->create(['role' => 'freelancer']);
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
