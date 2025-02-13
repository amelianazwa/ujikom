<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengembalianBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_peminjaman',
        'id_barang',
        'id_ruangan',
        'nama_peminjam',
        'tanggal_pengembalian',
        'jumlah_dikembalikan',
        'kondisi_barang',
        'keterangan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }
}
