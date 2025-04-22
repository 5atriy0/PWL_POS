<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangModel;
use App\Models\PenjualanModel;
use App\Models\PenjualanDetailModel;
use App\Models\StokModel;

class PenjualanController extends Controller
{
    public function index()
    {
        $activeMenu = 'penjualan';
        $breadcrumb = (object) [
            'title' => 'Transaksi Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $penjualan = PenjualanModel::with('details.barang')->orderBy('penjualan_tanggal', 'desc')->get();

        return view('penjualan.index', compact('activeMenu', 'breadcrumb', 'penjualan'));
    }

    public function list(Request $request)
    {
        $penjualan = PenjualanModel::with('details.barang')
            ->orderBy('penjualan_tanggal', 'desc')
            ->get();

        return datatables()->of($penjualan)
            ->addIndexColumn()
            ->addColumn('total_harga', function ($pj) {
                return 'Rp ' . number_format($pj->details->sum(fn($d) => $d->harga * $d->jumlah), 0, ',', '.');
            })
            ->addColumn('aksi', function ($pj) {
                return '<button onclick="modalAction(\'' . route('penjualan.show_ajax', $pj->penjualan_id) . '\')" class="btn btn-info btn-sm">Detail</button>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_ajax(string $id)
    {
        $penjualan = PenjualanModel::with('details.barang')->find($id);

        if (!$penjualan) {
            return response()->json([
                'status' => false,
                'message' => 'Data transaksi tidak ditemukan'
            ]);
        }

        return view('penjualan.show_ajax', compact('penjualan'));
    }
}