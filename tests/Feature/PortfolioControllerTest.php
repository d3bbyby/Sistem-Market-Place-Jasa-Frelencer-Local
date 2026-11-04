<?php

namespace Tests\Feature;

use App\Models\Category;
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
