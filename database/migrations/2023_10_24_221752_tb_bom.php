<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbBom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_bom', function (Blueprint $table) {
            $table->id('id_bom');
            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('id_bahan');
            $table->unsignedBigInteger('id_kategori');
            $table->string('nama_produk', 255)->nullable();
            $table->string('nama_kategori', 255)->nullable();
            $table->float('jumlah_produk');
            $table->string('internal_referensi', 255);
            $table->string('nama_bahan', 255)->nullable();
            $table->float('jumlah_bahan');
            $table->float('total_biaya_produk')->nullable();
            $table->float('total_biaya_bahan')->nullable();
            $table->float('total_bom')->nullable();
            $table->timestamps();

            $table->foreign('id_produk')->references('id_produk')->on('tb_produk');
            $table->foreign('id_bahan')->references('id_bahan')->on('tb_bahan');
            $table->foreign('id_kategori')->references('id_kategori')->on('tb_kategori');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_bom');
    }
}
