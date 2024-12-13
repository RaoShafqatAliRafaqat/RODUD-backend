<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_order_creation()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->postJson('/api/orders', [
            'location' => 'City A',
            'size' => 'Large',
            'weight' => 500,
            'pickup_time' => now()->addDay(),
            'delivery_time' => now()->addDays(2),
        ]);

        $response->assertStatus(201);
    }
}
