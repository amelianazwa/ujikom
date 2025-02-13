@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.12/sweetalert2.min.css">

<style>
    /* Custom styles */
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
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="row page-titles mx-0">
        <div class="col-sm-12 p-md-0">
            <h4 class="text-center">Data Ruangan</h4>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Ruangan</h5>
                <a href="{{ route('ruangan.create') }}" class="btn btn-sm btn-primary">Tambahkan Ruangan</a>
            </div>

            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped table-bordered" id="ruanganTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ruangan</th>
                                <th>Nama Penanggung Jawab</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @php $i = 1; @endphp
                            @foreach ($ruangan as $data)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $data->nama_ruangan }}</td>
                                <td>{{ $data->nama_pic }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('ruangan.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <button onclick="confirmDelete(event, {{ $data->id }})" class="btn btn-sm btn-danger">Delete</button>
                                        <form id="delete-form-{{ $data->id }}" action="{{ route('ruangan.destroy', $data->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
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
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.12/sweetalert2.all.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize DataTable
        new DataTable('#ruanganTable');

        // SweetAlert Notifications
        @if (session()->has('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if (session()->has('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    });

    function confirmDelete(event, id) {
        event.preventDefault(); // Mencegah submit langsung

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endpush
