<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penjualans', function (Blueprint $table) {
            if (!Schema::hasColumn('penjualans', 'harga')) {
                $table->integer('harga')->after('nama_barang');
            }
            if (!Schema::hasColumn('penjualans', 'total_harga')) {
                $table->integer('total_harga')->after('harga');
            }
            if (!Schema::hasColumn('penjualans', 'nama')) {
                $table->string('nama')->after('total_harga');
            }
            if (!Schema::hasColumn('penjualans', 'no_hp')) {
                $table->string('no_hp')->after('nama');
            }
            if (!Schema::hasColumn('penjualans', 'alamat')) {
                $table->text('alamat')->after('no_hp');
            }
            if (!Schema::hasColumn('penjualans', 'status')) {
                $table->string('status')->default('menunggu')->after('alamat');
            }
        });
    }

    public function down()
    {
        Schema::table('penjualans', function (Blueprint $table) {
            $table->dropColumn([
                'harga',
                'jumlah',
                'total_harga',
                'nama',
                'no_hp',
                'alamat',
                'status',
            ]);
        });
    }
};
