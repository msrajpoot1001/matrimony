<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perform_kanyadans', function (Blueprint $table) {
            $table->id();

            /* ================= USER LINK ================= */
            $table->foreignId('ref_id')
                ->constrained('users')
                ->cascadeOnDelete();

            /* ================= DONOR DETAILS ================= */
            $table->string('donor_name');
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('contact_number');
            $table->string('whatsapp_number')->nullable();
              $table->string('transction_id')->nullable();

            /* ================= KANYADAN DETAILS ================= */
            $table->string('kanyadan_type');
            $table->decimal('donation_amount', 12, 2)->nullable();
            $table->string('other_kanyadan')->nullable();
            $table->text('blessings')->nullable();

            $table->timestamps();
            $table->softDeletes(); // ✅ Laravel default
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perform_kanyadans');
    }
};
