<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('order_no')->unique();

            // Relation with astro_products
            $table->foreignId('astro_product_id')
                  ->constrained('astro_products')
                  ->cascadeOnDelete();

            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('pincode')->nullable();
            $table->text('address');

            $table->integer('amount'); // INR

            // Razorpay fields
            $table->string('razorpay_order_id')->nullable();
            $table->string('razorpay_payment_id')->nullable();
            $table->string('razorpay_signature')->nullable();

            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending');

            $table->timestamps();
             $table->softDeleteWithMeta(); // ✅ auto included in all new tables
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
