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
        Schema::create('section_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('animation')->nullable();
            $table->string('bgColor');
            $table->string('textColor');
            $table->integer('colSpan')->default(1);
            $table->integer('rowSpan')->default(1);
            $table->integer('colStart');
            $table->integer('rowStart');
            $table->boolean('isCarousel')->default(false);
            $table->json('images')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_items');
    }
};
