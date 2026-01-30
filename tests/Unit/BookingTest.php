<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Booking;
use App\Models\ClassModel;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_list_their_bookings()
    {
        $user = User::factory()->create();
        $class = ClassModel::factory()->create();

        $booking = Booking::factory()->create([
            'user_id' => $user->id,
            'class_id' => $class->id,
        ]);

        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson('/api/bookings');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'booking_id' => $booking->id,
                'class_id' => $class->id,
                'className' => $class->className,
                'instructor' => $class->instructor,
            ]);
    }

    /** @test */
    public function authenticated_user_can_create_a_booking()
    {
        $user = User::factory()->create();
        $class = ClassModel::factory()->create();

        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/bookings', [
            'class_id' => $class->id,
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'class_id' => $class->id,
                     'className' => $class->className,
                 ]);

        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'class_id' => $class->id,
        ]);
    }

    /** @test */
    public function user_cannot_book_the_same_class_twice()
    {
        $user = User::factory()->create();
        $class = ClassModel::factory()->create();

        Booking::factory()->create([
            'user_id' => $user->id,
            'class_id' => $class->id,
        ]);

        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/bookings', [
            'class_id' => $class->id,
        ]);

        $response->assertStatus(409)
                 ->assertJson([
                     'message' => 'Already booked',
                 ]);
    }

    /** @test */
    public function authenticated_user_can_delete_their_booking()
    {
        $user = User::factory()->create();
        $class = ClassModel::factory()->create();

        $booking = Booking::factory()->create([
            'user_id' => $user->id,
            'class_id' => $class->id,
        ]);

        Sanctum::actingAs($user, ['*']);

        $response = $this->deleteJson("/api/bookings/{$booking->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Booking deleted',
                 ]);

        $this->assertDatabaseMissing('bookings', [
            'id' => $booking->id,
        ]);
    }

    /** @test */
    public function user_cannot_delete_someone_elses_booking()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $class = ClassModel::factory()->create();

        $booking = Booking::factory()->create([
            'user_id' => $otherUser->id,
            'class_id' => $class->id,
        ]);

        Sanctum::actingAs($user, ['*']);

        $response = $this->deleteJson("/api/bookings/{$booking->id}");

        $response->assertStatus(404);

        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
        ]);
    }
}
