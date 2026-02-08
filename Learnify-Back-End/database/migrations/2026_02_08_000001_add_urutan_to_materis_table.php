<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('materis', function (Blueprint $table) {
            $table->integer('urutan')->default(0)->after('kelas_id');
        });

        // Set urutan based on existing created_at order per kelas
        $materis = DB::table('materis')->orderBy('kelas_id')->orderBy('created_at')->get();
        $kelasCounters = [];
        foreach ($materis as $materi) {
            if (!isset($kelasCounters[$materi->kelas_id])) {
                $kelasCounters[$materi->kelas_id] = 1;
            }
            DB::table('materis')->where('id', $materi->id)->update(['urutan' => $kelasCounters[$materi->kelas_id]]);
            $kelasCounters[$materi->kelas_id]++;
        }
    }

    public function down(): void
    {
        Schema::table('materis', function (Blueprint $table) {
            $table->dropColumn('urutan');
        });
    }
};
