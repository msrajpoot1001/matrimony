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
        Schema::create('karma_trainings', function (Blueprint $table) {
            $table->id();
            $table->string('user_type')->nullable();
             $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('contact_number');
            $table->string('whatsapp_number')->nullable();
            $table->string('qualification');
            $table->integer('experience_years');
            $table->string('location');
            $table->string('looking_for');
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
        Schema::dropIfExists('karma_trainings');
    }
};
