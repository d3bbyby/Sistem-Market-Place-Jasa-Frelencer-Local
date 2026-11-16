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
            ->get(route('admin.categories.index'))
            ->assertForbidden();

        $this->actingAs($freelancer)
            ->get(route('admin.subcategories.index'))
            ->assertForbidden();

        $this->actingAs($freelancer)
            ->post(route('categories.store'), ['category_name' => 'Desain'])
            ->assertForbidden();

        $this->assertDatabaseCount('categories', 0);
    }

    public function test_admin_category_list_counts_services_in_subcategories(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
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
            'category_id' => $parent->id,
            'title' => 'Jasa desain umum',
            'description' => 'Desain untuk berbagai kebutuhan.',
            'price' => 500000,
        ]);
        Service::create([
            'freelancer_id' => $freelancer->id,
            'category_id' => $child->id,
            'title' => 'Jasa desain logo',
            'description' => 'Pembuatan logo.',
            'price' => 500000,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.categories.index'))
            ->assertOk()
            ->assertSee('Lihat 2 jasa')
            ->assertSee('Lihat 1 jasa');
    }

    public function test_admin_category_search_finds_a_subcategory_and_keeps_its_parent_visible(): void
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
        Category::create([
            'category_name' => 'Fotografi',
            'slug' => 'fotografi',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.categories.index', ['q' => 'Logo']))
            ->assertOk()
            ->assertSee('Desain Grafis')
            ->assertSee('Desain Logo')
            ->assertDontSee('Fotografi');
    }

    public function test_admin_can_view_subcategories_with_parent_and_service_count(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $parent = Category::create([
            'category_name' => 'Desain Grafis',
            'slug' => 'desain-grafis',
        ]);
        $subcategory = Category::create([
            'category_name' => 'Desain Logo',
            'slug' => 'desain-logo',
            'parent_category_id' => $parent->id,
        ]);
        Service::create([
            'freelancer_id' => $freelancer->id,
            'category_id' => $subcategory->id,
            'title' => 'Desain logo profesional',
            'description' => 'Pembuatan logo.',
            'price' => 500000,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.subcategories.index'))
            ->assertOk()
            ->assertSee($subcategory->category_name)
            ->assertSee($parent->category_name)
            ->assertSee('1 jasa')
            ->assertSee('Dashboard');
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
