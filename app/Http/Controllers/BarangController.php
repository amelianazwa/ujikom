<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Merk;
use RealRashid\SweetAlert\Facades\Alert;

use Storage;
use Illuminate\Http\Request;

class BarangController extends Controller
{

    public function index()
    {
        $barang =  Barang::all();
        confirmDelete('Delete','Are you sure?');
        return view('barang.index', compact('barang'));
    }


    public function create()
    {
        $merk =  Merk::all();
        return view('barang.create', compact('merk'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required',

        ]);

        $barang = new barang();
        $barang->nama_barang = $request->nama_barang;
        $barang->id_merk = $request->id_merk;
        $barang->stok = $request->stok;

        Alert::success('Success','data berhasil disimpan')->autoClose(1000);
        $barang->save();

        return redirect()->route('barang.index');
    }


    public function show(barang $barang)
    {
        //
    }


    public function edit($id)
    {
        $merk =  Merk::all();
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang', 'merk'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required',

        ]);

        $barang = Barang::findOrFail($id);
        $barang->nama_barang = $request->nama_barang;
        $barang->id_merk = $request->id_merk;
        $barang->stok = $request->stok;

        Alert::success('Success','data berhasil dirubah')->autoClose(1000);
        $barang->save();

        return redirect()->route('barang.index');
    }


    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        if ($barang->pm_barang()->count() > 0) {
            return redirect()->route('barang.index')->with('error', 'barang tidak bisa di hapus karena masih berelasi.');
        }
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'barang berhasil di hapus.');
    }
}
