<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pengembalian_barangs', function (Blueprint $table) {
            $table->id();
            $table->integer('code_peminjaman')->unique();
            $table->bigInteger('id_barang')->unsigned();
            $table->foreign('id_barang')->references('id')->on('barangs')->onDelete('cascade');
            $table->bigInteger('id_ruangan')->unsigned();
            $table->foreign('id_ruangan')->references('id')->on('ruangans')->onDelete('cascade');
            $table->string('nama_peminjam');
            $table->date('tanggal_pengembalian');
            $table->integer('jumlah_dikembalikan');
            $table->enum('kondisi_barang', ['Baik', 'Rusak', 'Hilang']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengembalian_barangs');
    }
};
