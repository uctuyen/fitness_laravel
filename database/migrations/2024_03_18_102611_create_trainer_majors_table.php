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
        Schema::create('trainer_majors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('major_id');
            $table->unsignedBigInteger('trainer_id');

            $table->foreign('major_id')->references('id')->on('majors'); 
            $table->foreign('trainer_id')->references('id')->on('trainers'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainer_majors');
    }
};
