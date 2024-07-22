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
        Schema::table('bukus', function (Blueprint $table) {
            //
        });

        //db stetament stok
        DB::unprepared(
            "
            CREATE TRIGGER after_change_status
            AFTER UPDATE ON peminjaman
            FOR EACH ROW
            BEGIN
                DECLARE detail_bukus_ INT;


                IF NEW.status != OLD.status OR NEW.kondisi != OLD.kondisi THEN
                     SELECT bukus_id INTO detail_bukus_
                FROM detail_peminjaman
                WHERE OLD.id = detail_peminjaman.peminjaman_id;

                    IF NEW.status = 2 THEN
                    UPDATE bukus SET stok = stok - 1 WHERE id = detail_bukus_;

                    ELSEIF (NEW.status = 3 AND NEW.kondisi = 'normal' AND NEW.tanggal_pengembalian < OLD.tanggal_kembali) THEN
                    UPDATE bukus SET stok = stok + 1 WHERE id = detail_bukus_;

                    ELSEIF (NEW.status = 4 AND NEW.kondisi = 'normal') THEN
                    UPDATE bukus SET stok = stok + 1 WHERE id = detail_bukus_;
                    END IF;
                END IF;
            END ;"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            //
        });
        DB::statement("DROP TRIGGER IF EXISTS after_change_status");
    }
};
