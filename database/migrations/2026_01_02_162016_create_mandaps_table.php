<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mandaps', function (Blueprint $table) {
            $table->id();

            /* ================= USER LINK ================= */
            $table->foreignId('ref_id')
                ->constrained('users')
                ->cascadeOnDelete();

            /* ================= MANDAP FOR ================= */
            $table->string('user_type');
            $table->string('mandap_for');
            $table->string('other_event')->nullable();

            /* ================= PERSONAL DETAILS ================= */
            $table->string('full_name');
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('whatsapp_number')->nullable();

            /* ================= VENUE DETAILS ================= */
            $table->string('place_name');
            $table->integer('guest_count');
            $table->string('location');

            /* ================= DATE & CATEGORY ================= */
            $table->date('preferred_date');
            $table->string('venue_category');

            /* ================= ADDITIONAL ================= */
            $table->text('additional_requirements')->nullable();

            $table->timestamps();
            $table->softDeletes(); // ✅ Laravel default
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mandaps');
    }
};
