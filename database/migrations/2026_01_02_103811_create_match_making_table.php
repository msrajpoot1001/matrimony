<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('match_makings', function (Blueprint $table) {
            $table->id();

            /* ================= USER LINK ================= */
            $table->foreignId('ref_id')
                ->constrained('users')
                ->cascadeOnDelete();

            /* ================= SYSTEM ================= */
            $table->string('application_id')->unique()->nullable();

            /* ================= BASIC DETAILS ================= */
            $table->string('looking_for');                // Bride / Groom
            $table->string('candidate_name');
            $table->string('email')->nullable();
            $table->string('gender');
            $table->date('dob');
            $table->integer('height')->nullable();         // inches

            /* ================= PERSONAL & RELIGION ================= */
            $table->string('marital_status');
            $table->string('religion');
            $table->string('caste');
            $table->string('sub_caste')->nullable();
            $table->string('manglik_status')->nullable();
            $table->string('interest_inter_caste')->nullable();

            /* ================= PROFESSIONAL DETAILS ================= */
            $table->string('qualification');
            $table->string('company_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('place_of_work')->nullable();
            $table->integer('year_of_experience')->nullable();
            $table->string('employment_status');
            $table->string('annual_income')->nullable();

            /* ================= FAMILY DETAILS ================= */
            $table->string('father_name');
            $table->string('father_occupation');
            $table->string('mother_name');
            $table->string('mother_occupation');
            $table->string('family_income')->nullable();
            $table->string('family_status');
            $table->string('family_values');
            $table->string('living_with_family');
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
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('match_makings');
    }
};
