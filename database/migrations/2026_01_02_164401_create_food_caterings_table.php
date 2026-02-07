<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('food_caterings', function (Blueprint $table) {
            $table->id();

            /* ================= USER LINK ================= */
            $table->foreignId('ref_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('user_type')->nullable();
            $table->string('full_name');
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->integer('experience_years');
            $table->string('location');
            $table->string('looking_for');
            $table->string('other_service')->nullable();
            $table->text('add_require')->nullable();

            $table->timestamps();
            $table->softDeletes(); // ✅ Laravel default
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('food_caterings');
    }
};
