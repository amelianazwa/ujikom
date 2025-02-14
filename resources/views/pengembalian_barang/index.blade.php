@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container mt-4">
    <div class="row page-titles mx-0">
        <div class="col-sm-12 p-md-0">
            <h4 class="text-center">Pengembalian Barang</h4>
            <a href="{{ route('pengembalian_barang.create') }}" class="btn btn-sm btn-primary">Tambah Peminjaman</a>
        </div>
    </div>
</div>

<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pengembalian</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Peminjaman</th>
                            <th>Nama Barang</th>
                            <th>Nama Ruangan</th>
                            <th>Nama Peminjam</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Jumlah</th>
                            <th>Kondisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($pengembalianBarang as $data)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->code_peminjaman }}</td>
                            <td>{{ $data->barang->nama_barang }}</td>
                            <td>{{ $data->ruangan->nama_ruangan }}</td>
                            <td>{{ $data->nama_peminjam }}</td>
                            <td>{{ $data->tanggal_pengembalian }}</td>
                            <td>{{ $data->jumlah }}</td>
                            <td>{{ $data->kondisi }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('pengembalian_barang.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('pengembalian_barang.destroy', $data->id) }}" method="POST" class="mb-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" data-confirm-delete="true">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            searching: true,
            paging: true,
            ordering: true
        });
    });
</script>
@endpush
