@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #f8f9fa; border-bottom: 2px solid #ddd;">
                    <h5 class="mb-0"><i class="fas fa-box"></i> Edit Peminjaman Barang</h5>
                    <a href="{{ route('pm_barang.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('pm_barang.update', $pm_barang->id) }}" method="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kode Peminjaman</label>
                                <input type="text" class="form-control" name="code_peminjaman" value="{{ $pm_barang->code_peminjaman }}" required>
                            </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Peminjam</label>
                                <input type="text" class="form-control" name="nama_peminjam" value="{{ $pm_barang->nama_peminjam }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $pm_barang->email }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Instansi</label>
                            <select class="form-control" name="instansi" required>
                                @foreach(["Fakultas Ushuluddin", "Fakultas Tarbiyah Dan Keguruan", "Fakultas Syariah Dan Hukum", "Fakultas Dakwah Dan Komunikasi", "Fakultas Adab Dan Humaniora", "Fakultas Psikologi", "Fakultas Sains Dan Teknologi", "Fakultas Ilmu Sosial Dan Politik", "Fakultas Ekonomi Dan Bisnis Islam", "Program Pascasarjana", "Dosen", "Lainnya"] as $instansi)
                                    <option value="{{ $instansi }}" {{ $pm_barang->instansi == $instansi ? 'selected' : '' }}>{{ $instansi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Barang</label>
                                <select name="id_barang" class="form-control" required>
                                    @foreach ($barang as $data)
                                        <option value="{{ $data->id }}" {{ $pm_barang->id_barang == $data->id ? 'selected' : '' }}>{{ $data->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Ruangan</label>
                                <select name="id_ruangan" class="form-control" required>
                                    @foreach ($ruangan as $data)
                                        <option value="{{ $data->id }}" {{ $pm_barang->id_ruangan == $data->id ? 'selected' : '' }}>{{ $data->nama_ruangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal peminjaman</label>
                                <input type="date" class="form-control" name="tanggal_peminjaman" value="{{ $pm_barang->tanggal_peminjaman }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="3" required>{{ $pm_barang->keterangan }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" value="{{ $pm_barang->jumlah }}" required>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-outline-success"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
