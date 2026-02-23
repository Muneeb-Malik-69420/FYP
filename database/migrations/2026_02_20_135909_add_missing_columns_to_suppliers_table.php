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
    Schema::table('suppliers', function (Blueprint $table) {
        // Add status column (defaulting to 'pending')
        if (!Schema::hasColumn('suppliers', 'status')) {
            $table->string('status')->default('pending')->after('user_id');
        }
        
        // Ensure business_type exists
        if (!Schema::hasColumn('suppliers', 'business_type')) {
            $table->string('business_type')->after('business_name')->nullable();
        }

        // Ensure contact_phone exists
        if (!Schema::hasColumn('suppliers', 'contact_phone')) {
            $table->string('contact_phone')->after('business_type')->nullable();
        }

        // Ensure address exists
        if (!Schema::hasColumn('suppliers', 'address')) {
            $table->text('address')->after('contact_phone')->nullable();
        }

        // Ensure license_proof exists
        if (!Schema::hasColumn('suppliers', 'license_proof')) {
            $table->string('license_proof')->after('address')->nullable();
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suppliers', function (Blueprint $table) {
            //
        });
    }
};
