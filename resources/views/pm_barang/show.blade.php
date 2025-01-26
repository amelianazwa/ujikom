@extends('layouts.admin')

@section('content')
<div class="container">
    <!-- Button to trigger modal -->
    <div class="text-center my-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showDataModal" >
            Lihat Data Peminjaman
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="showDataModal" tabindex="-1" aria-labelledby="showDataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showDataModalLabel">Lihat Data Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nama Peminjam</label>
                            <input type="text" class="form-control" name="nama_peminjam" value="{{ $pm_barang->nama_peminjam }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ $pm_barang->email }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Instansi</label>
                            <input type="text" class="form-control" name="instansi" value="{{ $pm_barang->instansi }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" name="id_barang" value="{{ $pm_barang->barang->nama_barang }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Ruangan</label>
                            <input type="text" class="form-control" name="id_ruangan" value="{{ $pm_barang->ruangan->nama_ruangan }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Peminjaman</label>
                            <input type="text" class="form-control" name="tanggal_peminjaman" value="{{ $pm_barang->tanggal_peminjaman }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pengembalian</label>
                            <input type="text" class="form-control" name="tanggal_pengembalian" value="{{ $pm_barang->tanggal_pengembalian }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" value="{{ $pm_barang->keterangan }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="text" class="form-control" name="jumlah" value="{{ $pm_barang->jumlah }}" disabled>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a href="{{ url('pm_barang') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
