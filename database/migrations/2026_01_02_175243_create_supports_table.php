<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supports', function (Blueprint $table) {
            $table->id();

            /* ================= USER LINK ================= */
            $table->foreignId('ref_id')
                ->constrained('users')
                ->cascadeOnDelete();

            /* ================= CONTRIBUTOR DETAILS ================= */
            $table->string('user_type')->nullable();
            $table->string('full_name');
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('contact_number');
            $table->string('whatsapp_number')->nullable();
            $table->string('location');

            /* ================= CONTRIBUTION DETAILS ================= */
            $table->string('contribution_type');
            $table->decimal('amount', 12, 2)->nullable();
            $table->string('transction_id')->nullable();
            $table->string('other_contribution')->nullable();
            $table->text('message')->nullable();

            $table->timestamps();
            $table->softDeletes(); // ✅ Laravel default
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supports');
    }
};
