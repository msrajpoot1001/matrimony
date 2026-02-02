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
        Schema::create('astrologies', function (Blueprint $table) {
            $table->id();      
            $table->string('user_type');
            $table->string('name');
            $table->string('email');
            $table->string('gender');
            $table->date('dob')->nullable();
            $table->string('contact_number');
            $table->string('whatsapp_number')->nullable();
            $table->string('specialization');
            $table->integer('experience_years');
            $table->string('location');
            $table->string('services_offered');
            $table->string('other_service')->nullable();
            $table->text('add_require')->nullable();
            $table->timestamps();
            $table->softDeleteWithMeta(); // ✅ auto included in all new tables
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_astrologys');
    }
};
