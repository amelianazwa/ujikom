<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = ['id','nama_barang','id_merk','id_kategori','stok'];
    public $timestamps = true;

    public function merk()
    {
        return $this->belongsTo(Merk::class, 'id_merk');
    }
    public function m_Barang()
    {
        return $this->hasMany(m_Barang::class, 'id_barang');
    }

    public function pm_barang()
    {
        return $this->hasMany(pm_barang::class, 'id_barang');
    }

public function PengembalianBarang()
    {
        return $this->hasMany(PengembalianBarang::class, 'id_barang');
    }
}