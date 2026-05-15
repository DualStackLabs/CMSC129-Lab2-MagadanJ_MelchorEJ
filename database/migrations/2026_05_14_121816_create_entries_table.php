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
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('mood')->nullable();
            $table->string('location')->nullable();
            $table->boolean('is_favorite')->default(false);
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};
