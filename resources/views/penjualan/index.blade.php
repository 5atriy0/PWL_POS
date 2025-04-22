@extends('layouts.template')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Transaksi Penjualan</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-success" onclick="modalAction('{{ route('penjualan.create_ajax') }}')">Tambah Transaksi</button>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-sm table-striped table-hover" id="table-penjualan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Pembeli</th>
                    <th>Tanggal</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div id="myModal" class="modal fade animate shake" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="75%"></div>
@endsection

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function () {
            $('#myModal').modal('show');
        });
    }

    var dataPenjualan;
    $(document).ready(function () {
        dataPenjualan = $('#table-penjualan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('penjualan.list') }}",
                type: "POST",
                dataType: "json",
            },
            columns: [
                { data: "DT_RowIndex", className: "text-center", width: "5%", orderable: false, searchable: false },
                { data: "penjualan_kode", width: "20%", orderable: true, searchable: true },
                { data: "pembeli", width: "20%", orderable: true, searchable: true },
                { data: "penjualan_tanggal", width: "20%", orderable: true, searchable: false },
                { data: "total_harga", width: "20%", orderable: true, searchable: false },
                { data: "aksi", className: "text-center", width: "15%", orderable: false, searchable: false }
            ]
        });

        $('#table-penjualan_filter input').unbind().bind().on('keyup', function (e) {
            if (e.keyCode == 13) {
                dataPenjualan.search(this.value).draw();
            }
        });
    });
</script>
@endpush