@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Data Peminjaman Barang</div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nama peminjam</label>
                            <input type="text" class="form-control" name="nama_kasir" value="{{ $kasir->nama_kasir}}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="price" value="{{ $kasir->jenis_kelamin}}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Instansi</label>
                            <input type="text" class="form-control" name="alamat" value="{{ $kasir->alamat}}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" name="nomor_telepon" value="{{ $kasir->nomor_telepon}}" disabled>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama ruangan</label>
                        <input type="text" class="form-control" name="nomor_telepon" value="{{ $kasir->nomor_telepon}}" disabled>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Peminjaman</label>
                    <input type="text" class="form-control" name="nomor_telepon" value="{{ $kasir->nomor_telepon}}" disabled>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Pengembalian</label>
                <input type="text" class="form-control" name="nomor_telepon" value="{{ $kasir->nomor_telepon}}" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <input type="text" class="form-control" name="nomor_telepon" value="{{ $kasir->nomor_telepon}}" disabled>
            </div>
                            <a href="{{url('kasir')}}" class="btn btn-primary">Kembali</a>

                        </form>

                </div>
        </div>
    </div>
</div>
</div>
@endsection
