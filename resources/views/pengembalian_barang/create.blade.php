@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('Pengembalian Barang') }}
                    </div>
                    <div class="float-end">
                        <a href="{{ route('pengembalian_barang.index') }}" class="btn btn-sm btn-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('pengembalian_barang.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="">Kode Peminjaman</label>
                            <select name="pm_barang" class="form-control">
                                @foreach ($pm_barang as $data)
                                    <option value="{{$data->id}}">{{ $data->code_peminjaman}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="">Nama Barang</label>
                            <select name="id_barang" class="form-control">
                                @foreach ($barang as $data)
                                    <option value="{{$data->id}}">{{ $data->nama_barang}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="">Nama Ruangan</label>
                            <select name="id_ruangan" class="form-control">
                                @foreach ($ruangan as $data)
                                    <option value="{{$data->id}}">{{ $data->nama_ruangan}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">nama</label>
                            <input type="name" class="form-control @error('nama_pengembali') is-invalid @enderror" name="nama_pengembali"
                            value="{{ old('nama_pengembali') }}" required>
                            @error('nama_pengembali')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Tanggal Pengembalian</label>
                            <input type="date" class="form-control @error('tanggal_pengembalian') is-invalid @enderror" name="tanggal_pengembalian"
                            value="{{ old('tanggal_pengembalian') }}" required>
                            @error('tanggal_pengembalian')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Jumlah</label>
                            <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah"
                            value="{{ old('jumlah') }}" min="1" required>
                            @error('jumlah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kondisi</label>
                            <select name="kondisi" class="form-control">
                                <option value="Baik">Baik</option>
                                <option value="Rusak">Rusak</option>
                                <option value="Hilang">Hilang</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                            value="{{ old('keterangan') }}" placeholder="Keterangan">
                            @error('keterangan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <br>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
