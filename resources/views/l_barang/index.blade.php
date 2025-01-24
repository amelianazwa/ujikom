@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container mt-10">
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Tanggal Peminjaman</label>
                    <input type="date" id="start_date" class="form-control">
                </div>
                <div class="col-md-4 align-self-end">
                    <button id="filterBtn" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h5>Laporan Peminjaman Barang</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Peminjam</th>
                            <th>Email</th>
                            <th>Instansi</th>
                            <th>Nama Barang</th>
                            <th>Nama Ruangan</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @php $i = 1; @endphp
                        @foreach ($pm_barang as $data)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->nama_peminjam }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->instansi }}</td>
                            <td>{{ $data->barang->nama_barang }}</td>
                            <td>{{ $data->ruangan->nama_ruangan }}</td>
                            <td>{{ $data->tanggal_peminjaman }}</td>
                            <td>{{ $data->tanggal_pengembalian }}</td>
                            <td>{{ $data->keterangan }}</td>
                            <td>{{ $data->kondisi->kondisi }}</td>
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
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const table = new DataTable('#example', {
            dom: 'Bfrtip',
            buttons: [
                { extend: 'pdf', className: 'btn btn-sm btn-danger' },
                { extend: 'excel', className: 'btn btn-sm btn-success' }
            ]
        });

        const filterBtn = document.getElementById('filterBtn');
        const startDateInput = document.getElementById('start_date');

        filterBtn.addEventListener('click', function () {
            const startDate = startDateInput.value;

            if (startDate) {
                const filteredData = table.rows().data().filter((data, index) => {
                    const peminjamanDate = new Date(data[6]); // Kolom tanggal peminjaman
                    const start = new Date(startDate);

                    return peminjamanDate >= start;
                });

                table.clear().rows.add(filteredData).draw();
            } else {
                alert('Harap masukkan tanggal mulai.');
            }
        });
    });
</script>
@endpush
