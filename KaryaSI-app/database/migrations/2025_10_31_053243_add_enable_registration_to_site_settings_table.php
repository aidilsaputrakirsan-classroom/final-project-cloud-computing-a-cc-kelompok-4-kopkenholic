<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // aman jika kolom belum ada
        if (!Schema::hasColumn('site_settings', 'enable_registration')) {
            Schema::table('site_settings', function (Blueprint $table) {
                $table->boolean('enable_registration')->default(true)->after('site_title');
            });
        }
    }

    public function down(): void {
        if (Schema::hasColumn('site_settings', 'enable_registration')) {
            Schema::table('site_settings', function (Blueprint $table) {
                $table->dropColumn('enable_registration');
            });
        }
    }
};
