<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\pm_barang;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;
use Illuminate\Http\Request;

class PmBarangController extends Controller
{
    public function viewPDF(Request $request)
    {
        $pm_barang = pm_barang::findOrFail($request->idPeminjaman);

        $data = [
            'date' => date('m/d/Y'),
            'pm_barang' => $pm_barang,

        ];

        $pdf = PDF::loadView('pm_barang.export-pdf', $data)
            ->setPaper('a4', 'portrait');
        return $pdf->stream();
    }

    public function viewBARANG(Request $request)
    {
        $pm_barang = pm_barang::findOrFail($request->idPeminjaman);

        $isi = [
            'date' => date('m/d/Y'),
            'pm_barang' => $pm_barang,

        ];

        $pdf = PDF::loadView('pm_barang.export-barang', $isi)
            ->setPaper('a4', 'portrait');
        return $pdf->stream();
    }

    public function __construct()
    {
        $this -> middleware('auth');
    }
    public function index()
    {
        $pm_barang =  pm_barang::all();
        confirmDelete('Kembalikan','Anda yakin ingin mengembalikan barang ini ?');
        return view('pm_barang.index', compact('pm_barang'));
    }


    public function create()
    {
        $barang =  Barang::all();
        $ruangan =  Ruangan::all();
        return view('pm_barang.create', compact('barang','ruangan'));
    }


    public function store(Request $request)
{
    $validated = $request->validate([
        'nama_peminjam' => 'required',
        'email' => 'required',
        'instansi' => 'required',
        'tanggal_peminjaman' => 'required',
        'tanggal_pengembalian' => 'required',
        'keterangan' => 'required',
        'cover' => 'file|mimes:jpeg,png,jpg,gif,svg,pdf|max:1024',
        'id_barang' => 'required|exists:barangs,id',
        'jumlah' => 'required|integer|min:1',
    ]);

    $barang = Barang::findOrFail($request->id_barang);

    if ($request->jumlah > $barang->stok) {
        return redirect()->route('pm_barang.create')->with(['error' => 'Stok Kurang!']);
    }

    $pm_barang = new pm_barang();
    $pm_barang->nama_peminjam = $request->nama_peminjam;
    $pm_barang->email = $request->email;
    $pm_barang->instansi = $request->instansi;
    $pm_barang->id_barang = $request->id_barang;
    $pm_barang->id_ruangan = $request->id_ruangan;
    $pm_barang->tanggal_peminjaman = $request->tanggal_peminjaman;
    $pm_barang->tanggal_pengembalian = $request->tanggal_pengembalian;
    $pm_barang->keterangan = $request->keterangan;
    $pm_barang->jumlah = $request->jumlah;

    // Kurangi stok barang
    $barang->stok -= $request->jumlah;
    $barang->save();

    if ($request->hasFile('cover')) {
        $img = $request->file('cover');
        $name = rand(1000, 9999) . $img->getClientOriginalName();
        $img->move('images/pm_barang', $name);
        $pm_barang->cover = $name;
    }

    $pm_barang->save();

    Alert::success('Success', 'Data berhasil disimpan')->autoClose(1000);
    return redirect()->route('pm_barang.index');
}



    public function show($id)
    {
        $pm_barang = Pm_barang::findOrFail($id);
        return view('pm_barang.show',compact('pm_barang'));
    }


    public function edit($id)
    {
        $barang =  Barang::all();
        $ruangan =  Ruangan::all();
        $pm_barang = pm_barang::findOrFail($id);
        return view('pm_barang.edit', compact('pm_barang','barang','ruangan'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_peminjam' => 'required',
            'email' => 'required',
            'instansi' => 'required',
            'tanggal_peminjaman' => 'required',
            'tanggal_pengembalian' => 'required',
            'keterangan' => 'required',
            'cover' => 'file|mimes:jpeg,png,jpg,gif,svg,pdf|max:1024',
        ]);

        $pm_barang = pm_barang::findOrFail($id);
        $pm_barang->nama_peminjam = $request->nama_peminjam;
        $pm_barang->email = $request->email;
        $pm_barang->instansi = $request->instansi;
        $pm_barang->id_barang = $request->id_barang;
        $pm_barang->id_ruangan = $request->id_ruangan;
        $pm_barang->tanggal_peminjaman = $request->tanggal_peminjaman;
        $pm_barang->tanggal_pengembalian = $request->tanggal_pengembalian;
        $pm_barang->keterangan = $request->keterangan;
        $pm_barang->jumlah = $request->jumlah;

        if ($request->hasFile('cover')) {
            $img = $request->file('cover');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/pm_barang', $name);
            $pm_barang->cover = $name;
        }

        Alert::success('Success','data berhasil diubah')->autoClose(1000);
        $pm_barang->save();
        return redirect()->route('pm_barang.index');
    }

    public function destroy($id)
{
    $pm_barang = pm_barang::findOrFail($id);
    $barang = Barang::findOrFail($pm_barang->id_barang);

    // Tambah stok sebelum menghapus peminjaman
    $barang->stok += $pm_barang->jumlah;
    $barang->save();

    // Hapus peminjaman dulu agar tidak ada constraint error
    $pm_barang->delete();

    Alert::success('Success', 'Data berhasil dihapus');
    return redirect()->route('pm_barang.index');
}


}
