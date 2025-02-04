@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
<style>
    /* Custom styles for the table and card */
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 5, 51, 0.1);
    }
    .table th {
        background-color: #007bff;
        color: white;
    }
    .table td {
        vertical-align: middle;
    }
    .btn-custom {
        background-color: #28a745;
        color: white;
    }
    .btn-custom:hover {
        background-color: #218838;
        color: white;
    }
    .btn-danger {
        background-color: #dc3545;
        color: white;
    }
    .btn-danger:hover {
        background-color: #c82333;
        color: white;
    }
    .btn-warning {
        background-color: #ffc107;
        color: black;
    }
    .btn-warning:hover {
        background-color: #e0a800;
        color: black;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="row page-titles mx-0">
        <div class="col-sm-12 p-md-0">
            <h4 class="text-center">Pendataan Barang</h4>
        </div>
    </div>
</div>

<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Barang</h5>
            <a href="{{ route('barang.create') }}" class="btn btn-sm btn-primary">Tambah Barang</a>
        </div>

        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Nama Merk</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @php $i = 1; @endphp
                        @foreach ($barang as $data)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->nama_barang }}</td>
                            <td>{{ $data->merk->nama_merk }}</td>
                            <td>{{ $data->stok }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <form action="{{ route('barang.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('barang.edit', $data->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a> |
                                        <a href="{{ route('barang.destroy', $data->id)}}"
                                             class="btn btn-sm btn-danger" data-confirm-delete="true">Delete</a>
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
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<script>
    new DataTable('#example');
</script>
@endpush
