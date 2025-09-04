<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if(!Schema::hasColumn('bookings', 'user_id')) {
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
            }
            if(!Schema::hasColumn('bookings', 'class_id')) {
                $table->unsignedBigInteger('class_id');
            }
           if(!Schema::hasColumn('bookings', 'created_at')) {
            $table->timestamps();
           }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'class_id', 'created_at', 'updated_at']);
        });
    }
};
