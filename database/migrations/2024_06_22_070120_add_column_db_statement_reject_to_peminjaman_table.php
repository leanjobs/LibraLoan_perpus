<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            //
        });

        DB::unprepared(
            "
             SET GLOBAL event_scheduler = ON;
             CREATE EVENT reject_peminjaman_more_than_3days
             ON SCHEDULE EVERY 1 MINUTE DO
             BEGIN
                UPDATE peminjaman
                SET status = 5
                WHERE DATEDIFF(NOW(), tanggal_pinjam) > 3
                AND status = 1;
            END;
            "
        );
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        DB::unprepared("DROP EVENT IF EXISTS reject_peminjaman_more_than_3days;");

        Schema::table('peminjaman', function (Blueprint $table) {
            //
        });
    }
};
