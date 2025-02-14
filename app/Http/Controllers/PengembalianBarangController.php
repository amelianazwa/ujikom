<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\pm_barang;
use App\Models\PengembalianBarang;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class PengembalianBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengembalianBarang = PengembalianBarang::all();
        confirmDelete('Kembalikan', 'Anda yakin ingin mengembalikan barang ini?');
        return view('pengembalian_barang.index', compact('pengembalianBarang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pm_barang = pm_barang::all();
        $barang = Barang::all();
        $ruangan = Ruangan::all();
        return view('pengembalian_barang.create', compact('pm_barang', 'barang', 'ruangan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pm_barang' => 'required|exists:pm_barangs,id',
            'id_barang' => 'required|exists:barangs,id',
            'id_ruangan' => 'required|exists:ruangans,id',
            'nama_peminjam' => 'required|string',
            'tanggal_pengembalian' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|in:Baik,Rusak,Hilang',
            'keterangan' => 'nullable|string',
        ]);

    $PengembalianBarang = new PengembalianBarang();
    $PengembalianBarang->id_pm_barang = $request->id_pm_barang;
    $PengembalianBarang->id_barang = $request->id_barang;
    $PengembalianBarang->id_ruangan = $request->id_ruangan;
    $PengembalianBarang->nama_peminjam = $request->nama_peminjam;
    $PengembalianBarang->tanggal_pengembalian = $request->tanggal_pengembalian;
    $PengembalianBarang->jumlah = $request->jumlah;
    $PengembalianBarang->kondisi = $request->kondisi;
    $PengembalianBarang->keterangan = $request->keterangan;

    $PengembalianBarang->save();

    Alert::success('Success', 'Data berhasil disimpan')->autoClose(1000);
    return redirect()->route('pengembalian_barang.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(PengembalianBarang $pengembalianBarang)
    {
        // $PengembalianBarang = PengembalianBarang::findOrFail($id);
        // return view('pengembalian_barang.show',compact('pengembalian_barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pengembalianBarang = PengembalianBarang::findOrFail($id);
        $pm_barang = pm_barang::all();
        $barang = Barang::all();
        $ruangan = Ruangan::all();
        return view('pengembalian_barang.edit', compact('pengembalianBarang', 'pm_barang', 'barang', 'ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_pm_barang' => 'required|exists:pm_barangs,id',
            'id_barang' => 'required|exists:barangs,id',
            'id_ruangan' => 'required|exists:ruangans,id',
            'nama_peminjam' => 'required|string',
            'tanggal_pengembalian' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|in:Baik,Rusak,Hilang',
            'keterangan' => 'nullable|string',
        ]);
        $pengembalianBarang = PengembalianBarang::findOrFail($id);
    $PengembalianBarang->id_pm_barang = $request->id_pm_barang;
    $PengembalianBarang->id_barang = $request->id_barang;
    $PengembalianBarang->id_ruangan = $request->id_ruangan;
    $PengembalianBarang->nama_peminjam = $request->nama_peminjam;
    $PengembalianBarang->tanggal_pengembalian = $request->tanggal_pengembalian;
    $PengembalianBarang->jumlah = $request->jumlah;
    $PengembalianBarang->kondisi = $request->kondisi;
    $PengembalianBarang->keterangan = $request->keterangan;

    $PengembalianBarang->save();
        Alert::success('Success', 'Data berhasil diperbarui')->autoClose(1000);
        return redirect()->route('pengembalian_barang.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Ambil data dari database sebelum dihapus
        $pengembalianBarang = PengembalianBarang::findOrFail($id);
        
        // Hapus data
        $pengembalianBarang->delete();

        Alert::success('Success', 'Data berhasil dihapus')->autoClose(1000);
        return redirect()->route('pengembalian_barang.index');
    }
}

