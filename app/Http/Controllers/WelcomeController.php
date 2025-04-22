<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokModel;
use App\Models\BarangModel;
use App\Models\SupplierModel;
use Yajra\DataTables\Facades\DataTables;

class WelcomeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Dashboard']
        ];

        $activeMenu = 'dashboard';

        $totalStok = StokModel::sum('stok_jumlah');

        return view('welcome', compact('breadcrumb', 'activeMenu', 'totalStok'));
    }

    public function list(Request $request)
    {
        $stokTerbaru = StokModel::with(['barang', 'supplier'])
            ->selectRaw('barang_id, supplier_id, SUM(stok_jumlah) as total_stok')
            ->groupBy('barang_id', 'supplier_id')
            ->get();

        return DataTables::of($stokTerbaru)
            ->addIndexColumn()
            ->rawColumns(['aksi'])
            ->make(true);
    }
}