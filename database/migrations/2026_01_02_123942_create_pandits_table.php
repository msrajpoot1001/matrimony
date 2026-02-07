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
        Schema::create('pandits', function (Blueprint $table) {
            $table->id();

            // 🔗 USER RELATION
            $table->foreignId('ref_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->string('name');
            $table->string('user_type')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('qualification');
            $table->integer('experience_years');
            $table->string('location');
            $table->json('services_offered');
            $table->string('other_service')->nullable();
            $table->text('add_require')->nullable();

            $table->timestamps();

            // soft delete with meta
            $table->softDeleteWithMeta();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pandits');
    }
};
