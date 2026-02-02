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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
             // Connect to users table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Address fields (you can expand as needed)
             $table->string('name')->nullable();
             $table->string('phone',20)->nullable();
            $table->string('street')->nullable();
            $table->string('landmark')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code', 20)->nullable();

            // Type (e.g., home, office, shipping, etc.)
            $table->string('type')->nullable(); // empty by default
            $table->timestamps();
            $table->softDeleteWithMeta();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
