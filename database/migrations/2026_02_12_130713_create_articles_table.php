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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('author')->nullable();
            $table->string('source_name')->nullable(); // e.g., "CNN"
            $table->string('category')->nullable();
            $table->string('url')->unique(); // strict unique constraint
            $table->string('image_url')->nullable();
            $table->timestamp('published_at');
            $table->string('api_provider'); // To track where we got it (nyt, guardian)
            $table->timestamps();
        
            // Indexes for performance
            $table->index('title'); 
            $table->index('published_at');
            $table->index('category');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
