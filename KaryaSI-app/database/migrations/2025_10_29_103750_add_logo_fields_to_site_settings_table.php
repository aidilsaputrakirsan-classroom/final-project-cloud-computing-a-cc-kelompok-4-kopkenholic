<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('site_settings', 'logo_light')) {
                $table->string('logo_light')->nullable()->after('id');
            }
            if (!Schema::hasColumn('site_settings', 'logo_dark')) {
                $table->string('logo_dark')->nullable()->after('logo_light');
            }
            if (!Schema::hasColumn('site_settings', 'site_title')) {
                $table->string('site_title')->nullable()->after('logo_dark');
            }
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['logo_light', 'logo_dark', 'site_title']);
        });
    }
};
