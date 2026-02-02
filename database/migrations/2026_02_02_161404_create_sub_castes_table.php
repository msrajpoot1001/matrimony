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
        Schema::create('sub_castes', function (Blueprint $table) {
            $table->id();
            
            $table->string('name')->nullable();
            $table->boolean('is_active')->nullable();
            $table->foreignId('ref_id')->constrained('castes')->onDelete('cascade');
            $table->timestamps();
            $table->softDeleteWithMeta(); // ✅ auto included in all new tables
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_castes');
    }
};
