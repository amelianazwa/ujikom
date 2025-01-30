@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
    .btn-custom {
        background-color: #007bff;
        color: white;
    }
    .btn-custom:hover {
        background-color: #0056b3;
        color: white;
    }
    .modal-header {
        background-color: #007bff;
        color: white;
    }
    .modal-footer {
        background-color: #f8f9fa;
    }
    .card {
        margin-bottom: 1rem;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="row page-titles mx-0">
        <div class="col-sm-12 p-md-0">
            <h4 class="text-center">Peminjaman Ruangan</h4>
        </div>
    </div>
</div>

<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Peminjaman</h5>
            <a href="{{ route('pm_ruangan.create') }}" class="btn btn-sm btn-primary">Tambah Peminjaman</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTable">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Penanggung Jawab</th>
                            <th>Nama Ruangan</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($pm_ruangan as $data)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->penanggungjawab }}</td>
                            <td>{{ $data->ruangan->nama_ruangan }}</td>
                            <td>{{ $data->tanggal_peminjaman }}</td>
                            <td>{{ $data->tanggal_pengembalian }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('pm_ruangan.edit', $data->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#pdfModal-{{ $data->id }}">
                                        <i class="fas fa-eye"></i> Tampilkan
                                    </button>
                                    <form action="{{ route('pm_ruangan.destroy', $data->id) }}" method="POST" class="mb-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="pdfModal-{{ $data->id }}" tabindex="-1" aria-labelledby="pdfModalLabel-{{ $data->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="pdfModalLabel-{{ $data->id }}">Detail Peminjaman Ruangan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form>
                                            @foreach ([
                                                'Penanggung Jawab' => $data->penanggungjawab,
                                                'Instansi' => $data->instansi,
                                                'Jenis Kegiatan' => $data->jenis_kegiatan,
                                                'Nama Ruangan' => $data->ruangan->nama_ruangan,
                                                'Tanggal Peminjaman' => $data->tanggal_peminjaman,
                                                'Tanggal Pengembalian' => $data->tanggal_pengembalian,
                                                'Keterangan' => $data->keterangan,
                                            ] as $label => $value)
                                                <div class="row mb-3">
                                                    <div class="col-md-4 fw-bold text-muted">{{ $label }}:</div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" value="{{ $value }}" disabled>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </form>
                                    </div>

                                    <div class="modal-footer d-flex justify-content-start">
                                        <form action="{{ route('pm_ruangan.view-pdf') }}" method="POST" class="mb-0 me-2">
                                            @csrf
                                            <input type="hidden" id="idPeminjaman" name="idPeminjaman" value="{{ $data->id }}" />
                                            <button type="submit" class="btn btn-sm btn-primary">Cetak Surat Peminjaman</button>
                                        </form>
                                    
                                        <form action="{{ route('pm_ruangan.view-ruangan') }}" method="POST" class="mb-0 me-2">
                                            @csrf
                                            <input type="hidden" id="idPeminjaman" name="idPeminjaman" value="{{ $data->id }}" />
                                            <button type="submit" class="btn btn-sm btn-primary">Cetak Surat Pengembalian</button>
                                        </form>
                                    
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
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