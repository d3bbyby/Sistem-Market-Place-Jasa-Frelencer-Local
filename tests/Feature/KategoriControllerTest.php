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

    public function test_admin_can_create_a_subcategory_under_a_main_category(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $parent = Category::create([
            'category_name' => 'Desain Grafis',
            'slug' => 'desain-grafis',
        ]);

        $this->actingAs($admin)->post(route('categories.store'), [
            'category_name' => 'Desain Logo',
            'parent_category_id' => $parent->id,
        ])->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('categories', [
            'category_name' => 'Desain Logo',
            'parent_category_id' => $parent->id,
        ]);
    }

    public function test_admin_can_open_the_bootstrap_category_form_with_parent_options(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Category::create([
            'category_name' => 'Desain Grafis',
            'slug' => 'desain-grafis',
        ]);

        $this->actingAs($admin)
            ->get(route('categories.create'))
            ->assertOk()
            ->assertSee('bootstrap@5.3.3', false)
            ->assertSee('Desain Grafis')
            ->assertSee('Jadikan kategori utama');
    }

    public function test_admin_cannot_nest_a_subcategory_under_another_subcategory(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $parent = Category::create([
            'category_name' => 'Desain Grafis',
            'slug' => 'desain-grafis',
        ]);
        $child = Category::create([
            'category_name' => 'Desain Logo',
            'slug' => 'desain-logo',
            'parent_category_id' => $parent->id,
        ]);

        $this->actingAs($admin)->from(route('categories.create'))
            ->post(route('categories.store'), [
                'category_name' => 'Logo Minimalis',
                'parent_category_id' => $child->id,
            ])
            ->assertRedirect(route('categories.create'))
            ->assertSessionHasErrors('parent_category_id');

        $this->assertDatabaseCount('categories', 2);
    }

    public function test_main_category_with_subcategories_cannot_be_deleted(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $parent = Category::create([
            'category_name' => 'Desain Grafis',
            'slug' => 'desain-grafis',
        ]);
        Category::create([
            'category_name' => 'Desain Logo',
            'slug' => 'desain-logo',
            'parent_category_id' => $parent->id,
        ]);

        $this->actingAs($admin)
            ->delete(route('categories.destroy', $parent))
            ->assertRedirect(route('categories.index'))
            ->assertSessionHas('error', 'Kategori utama tidak dapat dihapus karena masih memiliki subkategori.');

        $this->assertModelExists($parent);
    }

    public function test_main_category_page_lists_subcategories_and_their_services(): void
    {
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $parent = Category::create([
            'category_name' => 'Desain Grafis',
            'slug' => 'desain-grafis',
        ]);
        $child = Category::create([
            'category_name' => 'Desain Logo',
            'slug' => 'desain-logo',
            'parent_category_id' => $parent->id,
        ]);
        Service::create([
            'freelancer_id' => $freelancer->id,
            'category_id' => $child->id,
            'title' => 'Logo untuk bisnis',
            'description' => 'Jasa pembuatan logo.',
            'price' => 500000,
        ]);

        $this->get(route('categories.services', ['category' => $parent->slug]))
            ->assertOk()
            ->assertSee($child->category_name)
            ->assertSee('Logo untuk bisnis');
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
