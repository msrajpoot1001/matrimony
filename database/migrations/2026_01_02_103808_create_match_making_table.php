<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('match_makings', function (Blueprint $table) {
            $table->id();

            // System
            $table->string('application_id')->unique()->nullable();

            /* ================= BASIC DETAILS ================= */
            $table->string('looking_for');                // Bride / Groom
            $table->string('candidate_name');
            $table->string('email')->nullable();
            $table->string('gender');
            $table->date('dob');
            $table->integer('height')->nullable();         // in inches
            $table->string('contact_number');
            $table->string('whatsapp_number')->nullable();

            /* ================= PERSONAL & RELIGION ================= */
            $table->string('marital_status');
            $table->string('religion');
            $table->string('caste');
            $table->string('sub_caste')->nullable();
            $table->string('manglik_status')->nullable();  // Yes / No / Don't Know
            $table->string('interest_inter_caste')->nullable(); // Yes / No

            /* ================= PROFESSIONAL DETAILS ================= */
            $table->string('qualification');
            $table->string('company_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('place_of_work')->nullable();
            $table->integer('year_of_experience')->nullable();
            $table->string('employment_status');           // Working / Not Working
            $table->string('annual_income')->nullable();   // INR

            /* ================= FAMILY DETAILS ================= */
            $table->string('father_name');
            $table->string('father_occupation');
            $table->string('mother_name');
            $table->string('mother_occupation');
            $table->string('family_income')->nullable();
            $table->string('family_status');               // Middle / Upper / Rich
            $table->string('family_values');               // Orthodox / Modern / Liberal / Spiritual
            $table->string('living_with_family');          // Yes / No
            $table->string('living_at')->nullable();
            $table->string('ancestral_origin')->nullable();

            /* ================= HOROSCOPE ================= */
            $table->string('birth_place');
            $table->time('birth_time')->nullable();
            $table->text('kundali_details')->nullable();

            /* ================= UPLOADS ================= */
            $table->string('full_photo');
            $table->string('govt_id_proof')->nullable();
            $table->string('kundali')->nullable();

            /* ================= META ================= */
            $table->timestamps();
            $table->softDeletes(); // use standard Laravel soft deletes
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('match_makings');
    }
};
