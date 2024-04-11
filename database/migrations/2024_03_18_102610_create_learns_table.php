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
        Schema::create('learns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attendances_id');
            $table->date('registrater_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('amount',8,2);

            $table->foreign('attendances_id')->references('id')->on('attendances');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learns');
    }
};