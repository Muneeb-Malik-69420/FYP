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
    // Links to your cities table
    $table->foreignId('city_id')->nullable()->constrained()->onDelete('set null');
    // Stores the specific neighborhood for precise searching
    $table->string('area')->nullable()->after('business_location'); 
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
