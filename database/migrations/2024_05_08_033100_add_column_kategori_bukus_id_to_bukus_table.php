<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_bukus_id')
            ->after('created_at')
            ->require();

        $table->foreign('kategori_bukus_id')->references('id')->on('kategori_bukus')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->dropForeign(['kategori_bukus_id']);
            $table->dropColumn('kategori_bukus_id');
        });
    }
};
