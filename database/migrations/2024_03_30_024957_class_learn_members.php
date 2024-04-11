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
        Schema::create('class_learn_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('classes_id');
            $table->unsignedBigInteger('learn_id');

            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('classes_id')->references('id')->on('classes');
            $table->foreign('learn_id')->references('id')->on('learns');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
