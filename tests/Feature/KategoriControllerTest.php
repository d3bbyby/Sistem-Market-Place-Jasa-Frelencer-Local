<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KategoriControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_categories_with_unique_slugs(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->post(route('categories.store'), [
            'category_name' => 'Desain Grafis',
        ])->assertRedirect(route('categories.index'));

        $this->actingAs($admin)->post(route('categories.store'), [
            'category_name' => 'Desain Grafis',
        ])->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('categories', ['slug' => 'desain-grafis']);
        $this->assertDatabaseHas('categories', ['slug' => 'desain-grafis-2']);
    }

    public function test_freelancers_can_browse_but_not_manage_categories(): void
    {
        $freelancer = User::factory()->create(['role' => 'freelancer']);

        $this->actingAs($freelancer)
            ->get(route('categories.index'))
            ->assertOk();

        $this->actingAs($freelancer)
            ->post(route('categories.store'), ['category_name' => 'Desain'])
            ->assertForbidden();

        $this->assertDatabaseCount('categories', 0);
    }

    public function test_category_in_use_by_services_cannot_be_deleted(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $category = Category::create([
            'category_name' => 'Desain',
            'slug' => 'desain',
        ]);

        Service::create([
            'freelancer_id' => $freelancer->id,
            'category_id' => $category->id,
            'title' => 'Desain logo',
            'description' => 'Jasa desain logo.',
            'price' => 500000,
        ]);

        $this->actingAs($admin)
            ->delete(route('categories.destroy', $category))
            ->assertRedirect(route('categories.index'))
            ->assertSessionHas('error');

        $this->assertModelExists($category);
    }
}
