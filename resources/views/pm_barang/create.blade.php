@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-box"></i> Peminjaman Barang</h5>
                    <a href="{{ route('pm_barang.index') }}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('pm_barang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Peminjam</label>
                                <input type="text" class="form-control @error('nama_peminjam') is-invalid @enderror" name="nama_peminjam" value="{{ old('nama_peminjam') }}" placeholder="Masukkan nama" required>
                                @error('nama_peminjam')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Instansi</label>
                            <select class="form-control @error('instansi') is-invalid @enderror" name="instansi" required>
                                <option value="" disabled selected>Pilih Instansi</option>
                                @foreach(["Fakultas Ushuluddin", "Fakultas Tarbiyah Dan Keguruan", "Fakultas Syariah Dan Hukum", "Fakultas Dakwah Dan Komunikasi", "Fakultas Adab Dan Humaniora", "Fakultas Psikologi", "Fakultas Sains Dan Teknologi", "Fakultas Ilmu Sosial Dan Politik", "Fakultas Ekonomi Dan Bisnis Islam", "Program Pascasarjana", "Dosen", "Lainnya"] as $instansi)
                                    <option value="{{ $instansi }}" {{ old('instansi') == $instansi ? 'selected' : '' }}>{{ $instansi }}</option>
                                @endforeach
                            </select>
                            @error('instansi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Barang</label>
                                <select name="id_barang" class="form-control @error('id_barang') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Barang</option>
                                    @foreach ($barang as $data)
                                        <option value="{{ $data->id }}" {{ old('id_barang') == $data->id ? 'selected' : '' }}>{{ $data->nama_barang }}</option>
                                    @endforeach
                                </select>
                                @error('id_barang')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Ruangan</label>
                                <select name="id_ruangan" class="form-control @error('id_ruangan') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Ruangan</option>
                                    @foreach ($ruangan as $data)
                                        <option value="{{ $data->id }}" {{ old('id_ruangan') == $data->id ? 'selected' : '' }}>{{ $data->nama_ruangan }}</option>
                                    @endforeach
                                </select>
                                @error('id_ruangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Peminjaman</label>
                                <input type="date" class="form-control @error('tanggal_peminjaman') is-invalid @enderror" name="tanggal_peminjaman" value="{{ old('tanggal_peminjaman') }}" required>
                                @error('tanggal_peminjaman')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Pengembalian</label>
                                <input type="date" class="form-control @error('tanggal_pengembalian') is-invalid @enderror" name="tanggal_pengembalian" value="{{ old('tanggal_pengembalian') }}" required>
                                @error('tanggal_pengembalian')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" placeholder="Pinjam Untuk Apa" rows="3" required>{{ old('keterangan') }}</textarea>
                            @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" value="{{ old('jumlah') }}" placeholder="Masukkan jumlah" required>
                            @error('jumlah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dokumentasi</label>
                            <input type="file" class="form-control" name="cover">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
