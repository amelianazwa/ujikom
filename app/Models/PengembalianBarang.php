<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengembalianBarang extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'id_pm_barang',
        'id_barang',
        'id_ruangan',
        'nama_peminjam',
        'tanggal_pengembalian',
        'jumlah',
        'kondisi',
        'keterangan',];
    public $timestamps = true;
    
    public function pm_barang()
    {
        return $this->belongsTo(pm_barang::class, 'id_pm_barang');
    }
    
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
    
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }
}
