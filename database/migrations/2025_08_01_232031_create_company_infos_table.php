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
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id();
             // 1️⃣ Company Basic Info
    $table->string('company_name')->nullable();
    $table->string('client_name')->nullable();
    $table->string('title')->nullable();
    $table->text('description')->nullable();

    // 2️⃣ Emails
    $table->string('email1')->nullable();
    $table->string('email2')->nullable();
    $table->string('email3')->nullable();

    // 3️⃣ Phones
    $table->string('phone1', 20)->nullable();
    $table->string('phone2', 20)->nullable();
    $table->string('phone3', 20)->nullable();

    // 4️⃣ Addresses
    $table->string('address1', 500)->nullable();
    $table->string('address2', 500)->nullable();
    $table->string('address3', 500)->nullable();

    // 5️⃣ Social Links
    $table->string('facebook')->nullable();
    $table->string('instagram')->nullable();
    $table->string('twitter')->nullable();
    $table->string('youtube')->nullable();
    $table->string('linkedin')->nullable();
    $table->string('pinterest')->nullable();

    // 6️⃣ Website
    $table->string('website_url')->nullable();
    $table->text('google_map_location')->nullable();

    // 7️⃣ Files
    $table->string('logo')->nullable();
    $table->string('favicon')->nullable();
    $table->string('brochure')->nullable();

    $table->timestamps();
    $table->softDeleteWithMeta();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_infos');
    }
};
