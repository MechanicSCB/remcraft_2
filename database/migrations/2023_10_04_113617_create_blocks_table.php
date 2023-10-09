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
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedInteger('order');
            $table->foreignId('component_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('classes')->nullable();
            $table->string('inner_classes')->nullable();
            $table->string('padding')->default('20px 0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blocks');
    }
};
