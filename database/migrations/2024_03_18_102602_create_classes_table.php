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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('trainer_id');
            $table->unsignedBigInteger('major_id');
            $table->decimal('price',8,2)->nullable();
            $table->tinyInteger('quantity_member')->nullable();
            $table->timestamps();

            $table->foreign('major_id')->references('id')->on('majors'); 
            $table->foreign('trainer_id')->references('id')->on('trainers'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
