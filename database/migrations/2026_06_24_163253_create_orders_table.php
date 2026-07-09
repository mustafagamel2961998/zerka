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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->restrictOnDelete();
            $table->string('order_number')->unique();      
            $table->decimal('subtotal', 10, 2); 
            $table->decimal('tax_total', 10, 2)->default(0.00);
            $table->decimal('shipping_total', 10, 2)->default(0.00);
            $table->decimal('discount_total', 10, 2)->default(0.00);
            $table->decimal('grand_total', 10, 2);
            $table->string('coupon_code')->nullable();
            $table->string('payment_status')->default('pending'); // pending, paid, failed
            $table->text('notes')->nullable();
            $table->boolean('invoice_created')->default(false);
            $table->string('status')->default('pending');         // pending, processing, shipped, delivered, cancelled
            $table->timestamp('stock_deducted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
