<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PortfolioControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_freelancer_can_create_and_view_a_portfolio(): void
    {
        Storage::fake('public');
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer);

        $response = $this->actingAs($freelancer)->post(route('portfolios.store'), [
            'service_id' => $service->id,
            'title' => 'Brand identity project',
            'description' => 'A visual identity for a local business.',
            'project_link' => 'https://example.test/project',
            'image' => UploadedFile::fake()->createWithContent(
                'brand.png',
                base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/l2cAAAAASUVORK5CYII='),
            ),
        ]);

        $response->assertRedirect(route('portfolios.index'))
            ->assertSessionHas('success', 'Portofolio berhasil ditambahkan!');

        $portfolio = Portfolio::query()->sole();
        $this->assertSame($freelancer->id, $portfolio->user_id);
        $this->assertSame($service->id, $portfolio->service_id);
        $this->assertSame($portfolio->title, $portfolio->caption);
        $this->assertSame($portfolio->image, $portfolio->file_path);
        Storage::disk('public')->assertExists($portfolio->image);

        $this->get(route('portfolios.index'))
            ->assertOk()
            ->assertSee('Brand identity project')
            ->assertSee('A visual identity for a local business.');
    }

    public function test_freelancer_cannot_update_another_freelancers_portfolio(): void
    {
        $owner = User::factory()->create(['role' => 'freelancer']);
        $portfolio = Portfolio::create([
            'user_id' => $owner->id,
            'title' => 'Private portfolio',
            'caption' => 'Private portfolio',
        ]);
        $otherFreelancer = User::factory()->create(['role' => 'freelancer']);

        $this->actingAs($otherFreelancer)
            ->get(route('portfolios.edit', $portfolio))
            ->assertNotFound();

        $this->actingAs($otherFreelancer)
            ->delete(route('portfolios.destroy', $portfolio))
            ->assertNotFound();

        $this->assertModelExists($portfolio);
    }

    public function test_guest_cannot_manage_portfolios(): void
    {
        $this->get(route('portfolios.index'))->assertRedirect('/login');
    }

    public function test_freelancer_can_open_the_portfolio_form(): void
    {
        $freelancer = User::factory()->create(['role' => 'freelancer']);

        $this->actingAs($freelancer)
            ->get(route('portfolios.create'))
            ->assertOk()
            ->assertSee('Judul karya')
            ->assertSee('Gambar karya');
    }

    public function test_client_with_a_completed_order_can_rate_a_freelancers_portfolio(): void
    {
        $client = User::factory()->create(['role' => 'client']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer);
        $portfolio = Portfolio::create([
            'user_id' => $freelancer->id,
            'service_id' => $service->id,
            'title' => 'Brand identity project',
            'caption' => 'Brand identity project',
        ]);
        Order::create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'status' => 'SELESAI',
        ]);
        $comment = 'Hasil <script>berbahaya</script> memuaskan.';

        $this->actingAs($client)
            ->post(route('portfolios.ratings.store', $portfolio), [
                'rating' => 5,
                'comment' => $comment,
            ])
            ->assertRedirect()
            ->assertSessionHas('success', 'Rating portofolio berhasil disimpan.');

        $this->assertDatabaseHas('portfolio_ratings', [
            'portfolio_id' => $portfolio->id,
            'user_id' => $client->id,
            'rating' => 5,
            'comment' => $comment,
        ]);

        $this->get(route('jasa.show', $service))
            ->assertSee('Hasil &lt;script&gt;berbahaya&lt;/script&gt; memuaskan.', false)
            ->assertDontSee('<script>berbahaya</script>', false)
            ->assertSee('Perbarui rating Anda');

        $this->actingAs($freelancer)
            ->get(route('portfolios.index'))
            ->assertSee('5.0')
            ->assertSee('dari 1 rating');
    }

    public function test_client_can_update_their_portfolio_rating_without_creating_a_duplicate(): void
    {
        $client = User::factory()->create(['role' => 'client']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer);
        $portfolio = Portfolio::create([
            'user_id' => $freelancer->id,
            'service_id' => $service->id,
            'title' => 'Brand identity project',
            'caption' => 'Brand identity project',
        ]);
        Order::create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'status' => 'SELESAI',
        ]);
        $portfolio->ratings()->create([
            'user_id' => $client->id,
            'rating' => 3,
            'comment' => 'Cukup baik.',
        ]);

        $this->actingAs($client)
            ->post(route('portfolios.ratings.store', $portfolio), [
                'rating' => 4,
                'comment' => 'Revisi rating.',
            ])
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseCount('portfolio_ratings', 1);
        $this->assertDatabaseHas('portfolio_ratings', [
            'portfolio_id' => $portfolio->id,
            'user_id' => $client->id,
            'rating' => 4,
            'comment' => 'Revisi rating.',
        ]);
    }

    public function test_client_without_a_completed_order_cannot_rate_a_portfolio(): void
    {
        $client = User::factory()->create(['role' => 'client']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer);
        $portfolio = Portfolio::create([
            'user_id' => $freelancer->id,
            'service_id' => $service->id,
            'title' => 'Brand identity project',
            'caption' => 'Brand identity project',
        ]);

        $this->actingAs($client)
            ->post(route('portfolios.ratings.store', $portfolio), [
                'rating' => 5,
                'comment' => 'Belum pernah memesan.',
            ])
            ->assertForbidden();

        $this->assertDatabaseCount('portfolio_ratings', 0);
    }

    public function test_client_cannot_rate_a_freelancer_they_have_not_ordered_from(): void
    {
        $client = User::factory()->create(['role' => 'client']);
        $orderedFreelancer = User::factory()->create(['role' => 'freelancer']);
        $portfolioOwner = User::factory()->create(['role' => 'freelancer']);
        $orderedService = $this->createService($orderedFreelancer);
        $category = Category::create([
            'category_name' => 'Branding',
            'slug' => 'branding',
        ]);
        $portfolioService = Service::create([
            'freelancer_id' => $portfolioOwner->id,
            'category_id' => $category->id,
            'title' => 'Desain branding',
            'description' => 'Jasa desain branding.',
            'price' => 100000,
        ]);
        $portfolio = Portfolio::create([
            'user_id' => $portfolioOwner->id,
            'service_id' => $portfolioService->id,
            'title' => 'Portfolio milik freelancer lain',
            'caption' => 'Portfolio milik freelancer lain',
        ]);
        Order::create([
            'client_id' => $client->id,
            'service_id' => $orderedService->id,
            'status' => 'SELESAI',
        ]);

        $this->actingAs($client)
            ->post(route('portfolios.ratings.store', $portfolio), [
                'rating' => 5,
                'comment' => 'Pesanan ini milik freelancer berbeda.',
            ])
            ->assertForbidden();

        $this->assertDatabaseCount('portfolio_ratings', 0);
    }

    public function test_portfolio_rating_requires_a_score_from_one_to_five_and_a_comment(): void
    {
        $client = User::factory()->create(['role' => 'client']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer);
        $portfolio = Portfolio::create([
            'user_id' => $freelancer->id,
            'service_id' => $service->id,
            'title' => 'Brand identity project',
            'caption' => 'Brand identity project',
        ]);
        Order::create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'status' => 'SELESAI',
        ]);

        $this->actingAs($client)
            ->from(route('jasa.show', $service))
            ->post(route('portfolios.ratings.store', $portfolio), [
                'rating' => 6,
                'comment' => '',
            ])
            ->assertRedirect(route('jasa.show', $service))
            ->assertSessionHasErrors([
                'rating' => 'Rating harus antara 1 sampai 5.',
                'comment' => 'Komentar wajib diisi.',
            ]);

        $this->assertDatabaseCount('portfolio_ratings', 0);
    }

    public function test_guests_and_non_clients_cannot_submit_portfolio_ratings(): void
    {
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer);
        $portfolio = Portfolio::create([
            'user_id' => $freelancer->id,
            'service_id' => $service->id,
            'title' => 'Brand identity project',
            'caption' => 'Brand identity project',
        ]);

        $this->post(route('portfolios.ratings.store', $portfolio))
            ->assertRedirect('/login');

        $this->actingAs($freelancer)
            ->post(route('portfolios.ratings.store', $portfolio), [
                'rating' => 5,
                'comment' => 'Rating dari akun freelancer.',
            ])
            ->assertForbidden();

        $this->assertDatabaseCount('portfolio_ratings', 0);
    }

    private function createService(User $freelancer): Service
    {
        $category = Category::create([
            'category_name' => 'Desain',
            'slug' => 'desain',
        ]);

        return Service::create([
            'freelancer_id' => $freelancer->id,
            'category_id' => $category->id,
            'title' => 'Desain logo',
            'description' => 'Jasa desain logo.',
            'price' => 100000,
        ]);
    }
}
