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
        Schema::create('happy_stories', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->nullable();
            $table->string('reason');
            $table->string('heading')->nullable();
            $table->string('sub_heading')->nullable();
            $table->string('date')->nullable();
            $table->boolean('is_active')->default(1);
$table->timestamps();
            $table->softDeleteWithMeta(); // ✅ auto included in all new tables
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('happy_stories');
    }
};
