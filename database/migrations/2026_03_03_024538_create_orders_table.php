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
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            // Delivery Info
            $table->string('phone');
            $table->text('delivery_address');

            // Payment Info
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_method'); // 'cod' or 'card'
            $table->string('status')->default('pending'); // 'pending', 'confirmed', 'paid', 'cancelled'

            // Stripe Specific (Optional but recommended)
            $table->string('stripe_session_id')->nullable();
            $table->string('guest_name')->nullable()->after('phone');
            $table->string('guest_email')->nullable()->after('guest_name');
            $table->text('notes')->nullable()->after('guest_email');
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
