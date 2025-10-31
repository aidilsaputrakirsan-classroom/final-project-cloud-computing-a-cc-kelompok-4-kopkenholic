<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Tambah kolom hanya jika belum ada
        if (!Schema::hasColumn('site_settings', 'logo_light')) {
            Schema::table('site_settings', function (Blueprint $table) {
                $table->string('logo_light')->nullable()->after('id');
            });
        }
        if (!Schema::hasColumn('site_settings', 'logo_dark')) {
            Schema::table('site_settings', function (Blueprint $table) {
                $table->string('logo_dark')->nullable()->after('logo_light');
            });
        }
        if (!Schema::hasColumn('site_settings', 'site_name')) {
            Schema::table('site_settings', function (Blueprint $table) {
                $table->string('site_name')->nullable()->after('logo_dark');
            });
        }
    }

    public function down(): void
    {
        // Drop kolom jika ada
        if (Schema::hasColumn('site_settings', 'logo_light')) {
            Schema::table('site_settings', function (Blueprint $table) {
                $table->dropColumn('logo_light');
            });
        }
        if (Schema::hasColumn('site_settings', 'logo_dark')) {
            Schema::table('site_settings', function (Blueprint $table) {
                $table->dropColumn('logo_dark');
            });
        }
        if (Schema::hasColumn('site_settings', 'site_name')) {
            Schema::table('site_settings', function (Blueprint $table) {
                $table->dropColumn('site_name');
            });
        }
    }
};
