<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\ClassModel;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function class_model_has_fillable_attributes()
    {
        $fillable = ['className','instructor','time','spots','day'];
        $this->assertEquals($fillable, (new ClassModel())->getFillable());
    }

    /** @test */
    public function class_model_has_many_bookings()
    {
        $class = ClassModel::factory()->create();
        $booking = Booking::factory()->create([
            'class_id' => $class->id
        ]);

        $this->assertTrue($class->bookings->contains($booking));
        $this->assertInstanceOf(Booking::class, $class->bookings->first());
    }

    /** @test */
    public function classes_controller_returns_all_classes()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    
        $classes = ClassModel::factory()->count(3)->create();
    
        $response = $this->getJson('/api/classes');
    
        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }
}