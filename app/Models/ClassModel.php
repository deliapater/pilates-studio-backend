<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;
    protected $table = 'classes';
    protected $fillable = ['className','instructor','time','spots','day'];
    
    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}
