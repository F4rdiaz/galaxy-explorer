<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::table('missions', function (Blueprint $table) {
        if (!Schema::hasColumn('missions', 'astronot')) {
            $table->json('astronot')->nullable()->after('keterangan');
        }
    });
}

    public function down(): void
    {
        Schema::table('missions', function (Blueprint $table) {
            $table->dropColumn('astronot');
        });
    }
};
