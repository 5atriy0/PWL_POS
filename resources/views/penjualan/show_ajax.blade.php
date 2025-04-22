@empty($penjualan)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data transaksi yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('/penjualan') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Transaksi Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered">
                    <tr><th class="text-right col-3">Kode Transaksi :</th><td class="col-9">{{ $penjualan->penjualan_kode }}</td></tr>
                    <tr><th class="text-right col-3">Pembeli :</th><td class="col-9">{{ $penjualan->pembeli }}</td></tr>
                    <tr><th class="text-right col-3">Tanggal :</th><td class="col-9">{{ $penjualan->penjualan_tanggal }}</td></tr>
                    <tr>
                        <th class="text-right col-3">Barang yang Dibeli :</th>
                        <td class="col-9">
                            <ul>
                                @foreach($penjualan->details as $detail)
                                    <li>{{ $detail->barang->barang_nama }} - {{ $detail->jumlah }} pcs - Rp {{ number_format($detail->harga, 0, ',', '.') }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    <tr><th class="text-right col-3">Total Harga :</th><td class="col-9"><strong>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</strong></td></tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Tutup</button>
            </div>
        </div>
    </div>
@endempty