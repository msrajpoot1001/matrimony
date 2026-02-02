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
        Schema::create('supports', function (Blueprint $table) {
            $table->id();
              // Contributor details
            $table->string('user_type')->nullable();
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('contact_number');
            $table->string('whatsapp_number')->nullable();
            $table->string('location');

            // Contribution details
            $table->string('contribution_type');
            $table->decimal('amount', 12, 2)->nullable();
            $table->string('transction_id')->nullable();
            $table->string('other_contribution')->nullable();
            $table->text('message')->nullable();
            $table->timestamps();
            $table->softDeleteWithMeta(); // ✅ auto included in all new tables
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supports');
    }
};
