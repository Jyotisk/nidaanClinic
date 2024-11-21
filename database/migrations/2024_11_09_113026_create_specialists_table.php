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
        Schema::create('specialists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->string('doctor_name');
            $table->string('doctor_image');
            $table->text('descriptions')->nullable();
            $table->string('facebook_link',1000)->nullable();
            $table->string('instagram_link',1000)->nullable();
            $table->string('twitter_link',1000)->nullable();
            $table->string('linked_in_link',1000)->nullable();
            $table->unsignedBigInteger('entry_by');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialists');
    }
};
