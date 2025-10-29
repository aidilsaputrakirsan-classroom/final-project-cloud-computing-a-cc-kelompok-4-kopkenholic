use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('posts', function (Blueprint $table) {
            // sesuaikan posisi after(...) dengan kolom yang ada
            $table->tinyInteger('status')->default(1)->after('title');
            // kalau tabelmu belum punya soft deletes, aktifkan:
            // $table->softDeletes();
        });
    }
    public function down(): void {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('status');
            // kalau tadi menambah softDeletes:
            // $table->dropSoftDeletes();
        });
    }
};
