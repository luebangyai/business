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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->string('room_name');
            $table->string('image_path');
            $table->string('meeting_name')->nullable();
            $table->string('activities')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('organization_name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('type_room');
            $table->timestamp('booking_datetime');
            $table->text('more_detail')->nullable();
            $table->text('remark')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
