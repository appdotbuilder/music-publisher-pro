<?php

namespace Tests\Feature;

use App\Models\Artist;
use App\Models\SubscriptionPlan;
use App\Models\Tenant;
use App\Models\Track;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MusicPlatformTest extends TestCase
{
    use RefreshDatabase;

    public function test_welcome_page_displays_platform_information(): void
    {
        // Create some sample data
        SubscriptionPlan::factory()->create(['name' => 'Pro', 'price_monthly' => 99]);
        Tenant::factory()->create();
        Artist::factory()->create();
        Track::factory()->create(['revenue' => 1000]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->component('welcome')
                ->has('stats')
                ->has('subscription_plans')
        );
    }

    public function test_super_admin_can_access_dashboard(): void
    {
        $superAdmin = User::factory()->create([
            'role' => 'super_admin',
            'email' => 'admin@test.com'
        ]);

        $response = $this->actingAs($superAdmin)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->component('dashboard')
                ->where('dashboard_type', 'super_admin')
                ->has('stats')
        );
    }

    public function test_tenant_admin_can_access_dashboard(): void
    {
        $tenant = Tenant::factory()->create();
        $tenantAdmin = User::factory()->create([
            'role' => 'tenant_admin',
            'tenant_id' => $tenant->id,
        ]);

        $response = $this->actingAs($tenantAdmin)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->component('dashboard')
                ->where('dashboard_type', 'tenant_admin')
                ->has('tenant')
        );
    }

    public function test_artist_can_access_dashboard(): void
    {
        $tenant = Tenant::factory()->create();
        $user = User::factory()->create([
            'role' => 'artist',
            'tenant_id' => $tenant->id,
        ]);
        
        $artist = Artist::factory()->create([
            'user_id' => $user->id,
            'tenant_id' => $tenant->id,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->component('dashboard')
                ->where('dashboard_type', 'artist')
                ->has('artist')
                ->has('stats')
        );
    }

    public function test_artist_without_profile_sees_message(): void
    {
        $tenant = Tenant::factory()->create();
        $user = User::factory()->create([
            'role' => 'artist',
            'tenant_id' => $tenant->id,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->component('dashboard')
                ->where('dashboard_type', 'artist_no_profile')
                ->has('message')
        );
    }

    public function test_guest_cannot_access_dashboard(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }
}