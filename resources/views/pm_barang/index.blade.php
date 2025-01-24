@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container mt-10">
    <div class="row page-titles mx-0">
        <div class="col-sm-12 p-md-0"></div>
    </div>
</div>
<div class="container">

<div class="card">
    <div class="card-header">
        <div class="float-start">
            <h5>Peminjaman Barang</h5>
        </div>
        <div class="float-end">
            <a href="{{ route('pm_barang.create') }}" class="btn btn-sm btn-primary">Add</a>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Email</th>
                        <th>Nama Barang</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php $i = 1; @endphp
                    @foreach ($pm_barang as $data)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $data->nama_peminjam }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->barang->nama_barang }}</td>
                        <td>{{ $data->tanggal_peminjaman }}</td>
                        <td>{{ $data->tanggal_pengembalian }}</td>
                        <td>{{ $data->jumlah }}</td>

                        <td>
                            <form action="{{ route('pm_barang.destroy', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('pm_barang.edit', $data->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a> |

                                <!-- Button to trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#pdfModal-{{ $data->id }}">
                                    Tampilkan
                                </button>

                                <a href="{{ route('pm_barang.destroy', $data->id)}}"
                                     class="btn btn-sm btn-danger" data-confirm-delete="true">Delete</a>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="pdfModal-{{ $data->id }}" tabindex="-1" aria-labelledby="pdfModalLabel-{{ $data->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header bg-light text-dark">
                                    <h5 class="modal-title" id="pdfModalLabel-{{ $data->id }}"> Detail Peminjaman Barang
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                    
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="container">
                                        <!-- Form -->
                                        <form>
                                            <div class="row mb-3">
                                                <div class="col-md-4 fw-bold text-muted">Nama Peminjam:</div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" value="{{ $data->nama_peminjam }}" disabled>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 fw-bold text-muted">Email:</div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" value="{{ $data->email }}" disabled>
                                                </div>
                                            </div>
                                            <!-- Tambahkan detail lainnya seperti sebelumnya -->
                                        </form>
                                    </div>
                                </div>
                    
                                <!-- Modal Footer -->
                                <div class="modal-footer bg-light">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                                
                    

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
    new DataTable('#dataTable');
</script>
@endpush
