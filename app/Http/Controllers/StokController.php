<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\SupplierModel;
use App\Models\StokModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    public function index()
    {
        $activeMenu = 'stok';
        $breadcrumb = (object) [
            'title' => 'Data Stok',
            'list' => ['Home', 'Stok']
        ];

        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $supplier = SupplierModel::select('supplier_id', 'supplier_nama')->get();

        return view('stok.index', compact('activeMenu', 'breadcrumb', 'barang', 'supplier'));
    }

    public function list(Request $request)
    {
        $stok = StokModel::with(['barang', 'supplier'])
            ->select('stok_id','barang_id','supplier_id','stok_tanggal','stok_jumlah')
            ->orderBy('stok_tanggal', 'desc')
            ->get();

        return DataTables::of($stok)
            ->addIndexColumn()
            ->addColumn('aksi', function ($stok) {
                return '<button onclick="modalAction(\'' . route('stok.confirm_ajax', $stok->stok_id) . '\')" class="btn btn-danger btn-sm">Hapus</button>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create_ajax()
    {
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $supplier = SupplierModel::select('supplier_id', 'supplier_nama')->get();

        return view('stok.create_ajax', compact('barang', 'supplier'));
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'barang_id' => 'required|integer|exists:m_barang,barang_id',
                'supplier_id' => 'required|integer|exists:m_supplier,supplier_id',
                'stok_jumlah' => 'required|integer|min:1'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            StokModel::create([
                'barang_id' => $request->barang_id,
                'supplier_id' => $request->supplier_id,
                'stok_tanggal' => $request->stok_tanggal ?? now(), // Tetapkan default di Laravel
                'stok_jumlah' => $request->stok_jumlah,
                'user_id' => auth()->id()
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data stok berhasil disimpan'
            ]);
        }

        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $stok = StokModel::find($id);
        return view('stok.confirm_ajax', compact('stok'));
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $stok = StokModel::find($id);
            if ($stok) {
                $stok->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data stok berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data stok tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function latest()
    {
        $stokTerbaru = StokModel::with(['barang', 'supplier'])
            ->selectRaw('barang_id, supplier_id, SUM(stok_jumlah) as total_stok')
            ->groupBy('barang_id', 'supplier_id')
            ->get();

        return response()->json([
            'stokTerbaru' => $stokTerbaru,
            'totalStok' => StokModel::sum('stok_jumlah')
        ]);
    }
}