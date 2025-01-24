
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('Peminjaman Barang') }}
                    </div>
                    <div class="float-end">
                        <a href="{{ route('pm_barang.index') }}" class="btn btn-sm btn-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('pm_barang.update', $pm_barang->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf

                         <div class="mb-3">
                            <label class="form-label">Nama Peminjam</label>
                            <input type="text" class="form-control @error('nama_peminjam') is-invalid @enderror" name="nama_peminjam"
                                value="{{ $pm_barang->nama_peminjam }}" placeholder="Nama peminjam" required>
                            @error('nama_peminjam')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ $pm_barang->email }}" placeholder="Email" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Instansi</label>
                            <select class="form-control @error('instansi') is-invalid @enderror" name="instansi" required>
                                <option value="" disabled selected>Pilih Instansi</option>
                                <option value="Fakultas Ushuluddin" {{ old('instansi') == 'Fakultas Ushuluddin' ? 'selected' : '' }}>Fakultas Ushuluddin</option>
                                <option value="Fakultas Tarbiyah Dan Keguruan" {{ old('instansi') == 'Fakultas Tarbiyah Dan Keguruan' ? 'selected' : '' }}>Fakultas Tarbiyah Dan Keguruan</option>
                                <option value="Fakultas Syariah Dan Hukum" {{ old('instansi') == 'Fakultas Syariah Dan Hukum' ? 'selected' : '' }}>Fakultas Syariah Dan Hukum</option>
                                <option value="Fakultas Dakwah Dan Komunikasi" {{ old('instansi') == 'Fakultas Dakwah Dan Komunikasi' ? 'selected' : '' }}>Fakultas Dakwah Dan Komunikasi</option>
                                <option value="Fakultas Adab Dan Humaniora" {{ old('instansi') == 'Fakultas Adab Dan Humaniora' ? 'selected' : '' }}>Fakultas Adab Dan Humaniora</option>
                                <option value="Fakultas Psikologi" {{ old('instansi') == 'Fakultas Psikologi' ? 'selected' : '' }}>Fakultas Psikologi</option>
                                <option value="Fakultas Sains Dan Teknologi" {{ old('instansi') == 'Fakultas Sains Dan Teknologi' ? 'selected' : '' }}>Fakultas Sains Dan Teknologi</option>
                                <option value="Fakultas Ilmu Sosial Dan Politik" {{ old('instansi') == 'Fakultas Ilmu Sosial Dan Politik' ? 'selected' : '' }}>Fakultas Ilmu Sosial Dan Politik</option>
                                <option value="Fakultas Ekonomi Dan Bisnis Islam" {{ old('instansi') == 'Fakultas Ekonomi Dan Bisnis Islam' ? 'selected' : '' }}>Fakultas Ekonomi Dan Bisnis Islam</option>
                                <option value="Program Pascasarjana" {{ old('instansi') == 'Program Pascasarjana' ? 'selected' : '' }}>Program Pascasarjana</option>
                                <option value="Dosen" {{ old('instansi') == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                                <option value="Lainnya" {{ old('instansi') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>

                            </select>
                            @error('instansi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="">Nama Barang</label>
                            <select name="id_barang" id="" class="form-control">
                                @foreach ($barang as $item)
                                    <option value="{{$item->id}}" {{$item->id == $pm_barang->id_barang ? 'selected': ''}}>{{ $item->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="">Nama Ruangan</label>
                            <select name="id_ruangan" id="" class="form-control">
                                @foreach ($ruangan as $item)
                                    <option value="{{$item->id}}" {{$item->id == $pm_barang->id_ruangan ? 'selected': ''}}>{{ $item->nama_ruangan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Peminjaman</label>
                            <input type="date" class="form-control @error('tanggal_peminjaman') is-invalid @enderror" name="tanggal_peminjaman"
                                value="{{ $pm_barang->tanggal_peminjaman }}" placeholder="Tanggal peminjaman" required>
                            @error('tanggal_peminjaman')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Pengembalian</label>
                            <input type="date" class="form-control @error('tanggal_pengembalian') is-invalid @enderror" name="tanggal_pengembalian"
                                value="{{ $pm_barang->tanggal_pengembalian }}" placeholder="Tanggal pengembalian" required>
                            @error('tanggal_pengembalian')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="">Kondisi</label>
                            <select name="id_kondisi" id="" class="form-control">
                                @foreach ($kondisi as $item)
                                    <option value="{{$item->id}}" {{$item->id == $pm_barang->id_kondisi ? 'selected': ''}}>{{ $item->kondisi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                                value="{{ $pm_barang->keterangan }}" placeholder="Keterangan" required>
                            @error('keterangan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">jumlah</label>
                            <input type="text" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah"
                                value="{{ $pm_barang->jumlah }}" placeholder="jumlah" required>
                            @error('jumlah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dokumentasi</label>
                            <img src="{{ asset('/images/pm_barang/' . $pm_barang->cover) }}" width="100">
                            <input type="file" class="form-control" name="cover">
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary">SIMPAN</button>
                        <button type="reset" class="btn btn-sm btn-danger">RESET</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
