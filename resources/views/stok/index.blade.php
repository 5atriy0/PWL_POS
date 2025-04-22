@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Stok</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/stok/create_ajax') }}')" class="btn btn-success">Tambah Stok</button>
        </div>
    </div>
    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-sm table-striped table-hover" id="table-stok">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Nama Supplier</th>
                    <th>Tanggal Stok</th>
                    <th>Jumlah Stok</th>
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

    var dataStok;
$(document).ready(function () {
    dataStok = $('#table-stok').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('stok.list') }}",
            type: "POST",
            dataType: "json",
        },
        columns: [
            { data: "DT_RowIndex", className: "text-center", width: "5%", orderable: false, searchable: false },
            { data: "barang.barang_nama", width: "25%", orderable: true, searchable: true },
            { data: "supplier.supplier_nama", width: "25%", orderable: true, searchable: true },
            { data: "stok_tanggal", width: "25%", orderable: true, searchable: true },
            { data: "stok_jumlah", width: "20%", orderable: true, searchable: false },
            { data: "aksi", className: "text-center", width: "15%", orderable: false, searchable: false }
        ]
    });
});
</script>
@endpush