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
        Schema::create('seo_pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_name')->nullable();
            $table->string('title', 100)->nullable();        // Page title (up to ~60–70 chars)
            $table->string('description', 200)->nullable();  // Meta description (up to ~160 chars, extra buffer)
            $table->string('keywords', 255)->nullable();     // Comma-separated keywords
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->softDeleteWithMeta();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_pages');
    }
};
