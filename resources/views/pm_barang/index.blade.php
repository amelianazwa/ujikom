@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container mt-4">
    <div class="row page-titles mx-0">
        <div class="col-sm-12 p-md-0">
            <h4 class="text-center">Peminjaman Barang</h4>
        </div>
    </div>
</div>

<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Peminjaman</h5>
            <a href="{{ route('pm_barang.create') }}" class="btn btn-sm btn-primary">Tambah Peminjaman</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Peminjam</th>
                            <th>Kode Peminjaman</th>
                            <th>Email</th>
                            <th>Nama Barang</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($pm_barang as $data)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->nama_peminjam }}</td>
                            <td>{{ $data->code_peminjaman }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->barang->nama_barang }}</td>
                            <td>{{ $data->tanggal_peminjaman }}</td>
                            <td>{{ $data->jumlah }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('pm_barang.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#pdfModal-{{ $data->id }}">
                                        Tampilkan
                                    </button>
                                    <form action="{{ route('pm_barang.destroy', $data->id) }}" method="POST" class="mb-0">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('pm_barang.destroy', $data->id) }}"
                                             class="btn btn-sm btn-danger" data-confirm-delete="true">Hapus</a>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="pdfModal-{{ $data->id }}" tabindex="-1" aria-labelledby="pdfModalLabel-{{ $data->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-light text-dark">
                                        <h5 class="modal-title" id="pdfModalLabel-{{ $data->id }}">Detail Peminjaman Barang</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form>
                                            @foreach ([
                                                'Code Peminjaman' => $data->code_peminjaman,
                                                'Nama Peminjam' => $data->nama_peminjam,
                                                'Email' => $data->email,
                                                'Instansi' => $data->instansi,
                                                'Nama Barang' => $data->barang->nama_barang,
                                                'Nama Ruangan' => $data->ruangan->nama_ruangan,
                                                'Tanggal Peminjaman' => $data->tanggal_peminjaman,
                                                'Keterangan' => $data->keterangan,
                                                'Jumlah' => $data->jumlah
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

                                    <div class="modal-footer bg-light d-flex justify-content-between">
                                        <div class="d-flex align-items-center gap-2">
                                            <form action="{{ route('pm_barang.view-pdf') }}" method="POST" class="mb-0">
                                                @csrf
                                                <input type="hidden" id="idPeminjaman" name="idPeminjaman" value="{{ $data->id }}" />
                                                <button type="submit" class="btn btn-sm btn-primary">Cetak Surat Peminjaman</button>
                                            </form>

                                            <form action="{{ route('pm_barang.view-barang') }}" method="POST" class="mb-0">
                                                @csrf
                                                <input type="hidden" id="idPeminjaman" name="idPeminjaman" value="{{ $data->id }}" />
                                                <button type="submit" class="btn btn-sm btn-primary">Cetak Surat Pengembalian</button>
                                            </form>
                                        </div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Ensure jQuery is included -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            // You can customize options here if needed
            searching: true, // Enable searching
            paging: true, // Enable pagination
            ordering: true // Enable ordering
        });
    });
</script>
@endpush
