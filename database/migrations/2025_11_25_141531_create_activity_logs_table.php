<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            // User yang melakukan aktivitas
            $table->unsignedBigInteger('user_id');

            // Username saat aktivitas dicatat
            $table->string('username');

            // ID objek/karya yang berkaitan (opsional)
            $table->string('activity_id')->nullable();

            // Jenis aktivitas (view, edit, delete, create, etc)
            $table->string('activity');

            // Detail informasi aktivitas
            $table->text('detail')->nullable();

            // Timestamp (created_at & updated_at)
            $table->timestamps();

            // (Opsional) Foreign key ke users
            // Hapus komentar jika kamu ingin enforce FK
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
