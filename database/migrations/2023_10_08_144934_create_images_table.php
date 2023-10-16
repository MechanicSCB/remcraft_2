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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->unsignedFloat('order', 4, 1)->nullable();
            $table->string('name');
            $table->string('ext')->nullable();
            $table->string('title')->nullable();
            $table->string('alt')->nullable();
            $table->foreignId('gallery_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();

            $table->unique(['gallery_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
