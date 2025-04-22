@extends('layouts.template')

@section('content')

<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">👋 Selamat Datang!</h3>
    </div>
    <div class="card-body text-center">
        <h4 class="font-weight-bold">Aplikasi PWL - Starter Code</h4>
        <p class="text-muted">Selamat datang semua, ini adalah halaman utama dari aplikasi ini.</p>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header bg-success text-white">
        <h3 class="card-title text-center">📊 Stok Barang Real-Time</h3>
    </div>
    <div class="card-body">
        <div class="row text-center">
            <div class="col-md-6">
                <h4 class="text-lg font-weight-bold">Total Barang</h4>
                <h2 class="text-success font-weight-bold" id="total-stok">{{ $totalStok }}</h2>
            </div>
            <div class="col-md-6">
                <h4 class="text-lg font-weight-bold">Status Terakhir</h4>
                <p class="text-muted">Pembaruan setiap 10 detik...</p>
            </div>
        </div>

        <div id="stok-container">
            <table class="table table-bordered table-striped" id="table-stok">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>Nama Barang</th>
                        <th>Nama Supplier</th>
                        <th>Jumlah Stok</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    var dataStok;

    $(document).ready(function () {
        dataStok = $('#table-stok').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('/list') }}",
                type: "POST",
                dataType: "json",
            },
            columns: [
                { data: "barang.barang_nama", width: "40%", orderable: true, searchable: true },
                { data: "supplier.supplier_nama", width: "40%", orderable: true, searchable: true },
                { data: "total_stok", width: "20%", orderable: true, searchable: false },
            ]
        });

        // Animasi loading stok terbaru
        function loadStokTerbaru() {
            $("#total-stok").html('<i class="fas fa-sync-alt fa-spin"></i> Memuat...');
            
            $.ajax({
                url: "{{ route('stok.latest') }}",
                type: "GET",
                success: function(response) {
                    $("#total-stok").text(response.totalStok);
                },
                error: function(xhr) {
                    console.error("Gagal memuat data stok terbaru:", xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan',
                        text: 'Gagal memuat data stok terbaru, coba lagi nanti.'
                    });
                }
            });
        }

        setInterval(loadStokTerbaru, 10000);
    });
</script>
@endpush