<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('posts', function (Blueprint $table) {
            // letakkan setelah updated_at (tabelmu: id, created_at, updated_at, status)
            $table->softDeletes()->after('updated_at'); // menambah kolom deleted_at nullable
        });
    }

    public function down(): void {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropSoftDeletes(); // menghapus kolom deleted_at
        });
    }
};
