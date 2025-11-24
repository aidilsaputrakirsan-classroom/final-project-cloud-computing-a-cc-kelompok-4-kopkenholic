<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id(); // Primary key

            // Data pengirim
            $table->string('name');       // Nama pengirim
            $table->string('email');      // Email pengirim

            // Opsional: subjek pesan
            $table->string('subject')->nullable();

            // Isi pesan
            $table->text('message');

            // Bisa ditambah kolom tambahan seperti IP address atau status pesan
            $table->string('ip_address')->nullable(); // untuk mencatat IP pengirim
            $table->enum('status', ['unread', 'read'])->default('unread'); // default belum dibaca

            $table->timestamps(); // created_at dan updated_at otomatis
        });
    }

    /**
     * Rollback migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
