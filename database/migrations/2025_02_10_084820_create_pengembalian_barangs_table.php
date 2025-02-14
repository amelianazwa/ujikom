<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pengembalian_barangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pm_barang');
            $table->foreign('id_pm_barang')->references('id')->on('pm__barangs')->onDelete('cascade');

            $table->unsignedBigInteger('id_barang');
            $table->foreign('id_barang')->references('id')->on('barangs')->onDelete('cascade');

            $table->unsignedBigInteger('id_ruangan');
            $table->foreign('id_ruangan')->references('id')->on('ruangans')->onDelete('cascade');

            $table->string('nama_peminjam');
            $table->date('tanggal_pengembalian');
            $table->integer('jumlah');
            $table->enum('kondisi', ['Baik', 'Rusak', 'Hilang']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengembalian_barangs');
    }
};
