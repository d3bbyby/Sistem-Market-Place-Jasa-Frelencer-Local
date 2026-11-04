<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FreelancerDashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_freelancer_dashboard_shows_owned_services_and_order_statistics(): void
    {
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $client = User::factory()->create(['role' => 'client', 'name' => 'Dashboard Client']);
        $otherFreelancer = User::factory()->create(['role' => 'freelancer']);
        $service = $this->createService($freelancer, 'Landing Page Freelancer');
        $secondService = $this->createService($freelancer, 'Logo Freelancer');
        $otherService = $this->createService($otherFreelancer, 'Jasa Freelancer Lain');

        Order::create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'total_price' => 250000,
            'status' => 'SELESAI',
        ]);
        Order::create([
            'client_id' => $client->id,
            'service_id' => $secondService->id,
            'total_price' => 150000,
            'status' => 'DIPROSES',
        ]);
        Order::create([
            'client_id' => $client->id,
            'service_id' => $otherService->id,
            'total_price' => 900000,
            'status' => 'SELESAI',
        ]);

        $response = $this->actingAs($freelancer)->get(route('freelancer.dashboard'));

        $response->assertViewHas('totalServices', 2)
            ->assertViewHas('completedOrdersCount', 1)
            ->assertViewHas('totalIncome', 250000.0)
            ->assertViewHas('totalOrders', 2)
            ->assertSee('Pesanan Selesai')
            ->assertSee('Rp250.000')
            ->assertSee('Total Pesanan Masuk')
            ->assertSee('Dashboard Client')
            ->assertSee('Landing Page Freelancer')
            ->assertSee('Logo Freelancer')
            ->assertDontSee('Jasa Freelancer Lain');
    }

    public function test_guest_is_redirected_to_login_from_freelancer_dashboard(): void
    {
        $this->get(route('freelancer.dashboard'))->assertRedirect('/login');
    }

    public function test_non_freelancer_is_forbidden_from_freelancer_dashboard(): void
    {
        $client = User::factory()->create(['role' => 'client']);

        $this->actingAs($client)
            ->get(route('freelancer.dashboard'))
            ->assertForbidden();
    }

    private function createService(User $freelancer, string $title): Service
    {
        $category = Category::create([
            'category_name' => 'Desain',
            'slug' => 'desain-'.strtolower(str_replace(' ', '-', $title)),
        ]);

        return Service::create([
            'freelancer_id' => $freelancer->id,
            'category_id' => $category->id,
            'title' => $title,
            'description' => 'Deskripsi '.$title,
            'price' => 100000,
        ]);
    }
}
