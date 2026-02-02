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
        Schema::create('home_hero_contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('bg_image')->nullable();
            $table->boolean('status')->default(1); // 1 = active, 0 = inactive
            $table->timestamps();
            $table->softDeleteWithMeta(); // ✅ auto included in all new tables
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_hero_contents');
    }
};
