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
        Schema::create('book_appointments', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->string('age');
            $table->string('phone_no',10);
            $table->string('address');
            $table->text('message')->nullable();
            $table->unsignedBigInteger('specialist_id');
            $table->date('appointment_date');
            $table->date('entry_date');
            $table->string('status')->comment('new,mark_read,delete,booking_completed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_appointments');
    }
};
