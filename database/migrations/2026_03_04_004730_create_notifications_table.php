<?php
// Migration 2: create_notifications_table
// File: database/migrations/xxxx_create_notifications_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // 'order_update' | 'promotion'
            $table->string('title');
            $table->text('body');
            $table->string('icon')->default('fa-bell'); // FontAwesome icon
            $table->string('link')->nullable(); // optional deep link
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'read_at']); // fast unread count queries
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};