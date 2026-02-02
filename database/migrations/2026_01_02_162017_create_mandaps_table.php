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
        Schema::create('mandaps', function (Blueprint $table) {
            $table->id();
               // Mandap For
               
            $table->string('user_type');
            $table->string('mandap_for');
            $table->string('other_event')->nullable();

            // Personal Details
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('contact_number');
            $table->string('whatsapp_number')->nullable();

            // Venue Details
            $table->string('place_name');
            $table->integer('guest_count');
            $table->string('location');

            // Date & Category
            $table->date('preferred_date');
            $table->string('venue_category');

            // Additional
            $table->text('additional_requirements')->nullable();
            $table->timestamps();
            $table->softDeleteWithMeta(); // ✅ auto included in all new tables
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mandaps');
    }
};
