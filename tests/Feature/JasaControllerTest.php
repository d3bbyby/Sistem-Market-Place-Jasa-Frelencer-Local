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

        $response = $this->actingAs($service->freelancer)->delete(route('jasa.destroy', $service));

        $response->assertRedirect(route('jasa.index'))
            ->assertSessionHas('error', $message);
        $this->assertModelExists($service);
        $this->assertDatabaseHas('orders', [
            'client_id' => $client->id,
            'service_id' => $service->id,
        ]);

        $this->actingAs($service->freelancer)->get(route('jasa.index'))->assertSee($message);
    }

    public function test_service_without_orders_can_be_deleted(): void
    {
        $service = $this->createService();

        $response = $this->actingAs($service->freelancer)->delete(route('jasa.destroy', $service));

        $response->assertRedirect(route('jasa.index'))
            ->assertSessionHas('success', 'Jasa berhasil dihapus!');
        $this->assertModelMissing($service);
    }

    public function test_service_listing_displays_fallbacks_for_missing_relationships(): void
    {
        $service = $this->createService();
        $service->setRelation('freelancer', null);
        $service->setRelation('category', null);

        $response = $this->view('jasa.index', ['jasa' => collect([$service])]);

        $response->assertSee('Freelancer tidak tersedia')
            ->assertSee('Tanpa kategori');
    }

    public function test_service_detail_shows_interactive_package_data_and_gallery(): void
    {
        $service = $this->createService();
        $service->update([
            'plus_price' => 2500000,
            'premium_price' => 3500000,
            'plus_features' => ['Tiga revisi'],
            'premium_features' => ['Revisi tanpa batas'],
            'main_image' => 'services/utama.jpg',
            'gallery_images' => ['services/galeri.jpg'],
        ]);

        $this->get(route('jasa.show', $service))
            ->assertOk()
            ->assertSee($service->title)
            ->assertSee('Tiga revisi')
            ->assertSee('Revisi tanpa batas')
            ->assertSee('2500000')
            ->assertSee('services/galeri.jpg', false)
            ->assertSee('Masuk untuk membeli');
    }

    public function test_freelancers_can_browse_services_by_category_slug(): void
    {
        $service = $this->createService();

        $this->get(route('categories.services', ['category' => $service->category->slug]))
            ->assertOk()
            ->assertSee($service->title)
            ->assertSee('Lihat detail');
    }

    public function test_freelancer_cannot_manage_another_freelancers_service(): void
    {
        $service = $this->createService();
        $otherFreelancer = User::factory()->create(['role' => 'freelancer']);

        $this->actingAs($otherFreelancer)
            ->get(route('jasa.edit', $service))
            ->assertNotFound();
    }

    public function test_freelancer_can_create_a_service_with_packages_and_gallery_images(): void
    {
        Storage::fake('public');
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $category = Category::create([
            'category_name' => 'Web Design',
            'slug' => 'web-design',
        ]);
        $image = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/l2cAAAAASUVORK5CYII=';

        $response = $this->actingAs($freelancer)->post(route('jasa.store'), [
            'category_id' => $category->id,
            'title' => 'Landing Page Premium',
            'description' => 'Desain landing page untuk bisnis lokal.',
            'price' => 1000000,
            'plus_price' => 2000000,
            'premium_price' => 3000000,
            'basic_features' => "Satu halaman\nResponsif",
            'plus_features' => "Lima halaman\nDua revisi",
            'premium_features' => "Sepuluh halaman\nRevisi tanpa batas",
            'main_image' => UploadedFile::fake()->createWithContent('main.png', base64_decode($image)),
            'gallery_images' => [
                UploadedFile::fake()->createWithContent('gallery.png', base64_decode($image)),
            ],
        ]);

        $response->assertRedirect(route('jasa.index'))
            ->assertSessionHas('success', 'Jasa berhasil ditambahkan!');

        $service = Service::query()->sole();
        $this->assertSame($freelancer->id, $service->freelancer_id);
        $this->assertSame(['Satu halaman', 'Responsif'], $service->basic_features);
        $this->assertSame(2000000.0, (float) $service->plus_price);
        Storage::disk('public')->assertExists($service->main_image);
        Storage::disk('public')->assertExists($service->gallery_images[0]);
    }

    public function test_freelancer_can_open_the_service_form(): void
    {
        $freelancer = User::factory()->create(['role' => 'freelancer']);

        $this->actingAs($freelancer)
            ->get(route('jasa.create'))
            ->assertOk()
            ->assertSee('Harga (Rp)')
            ->assertSee('Galeri foto');
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
