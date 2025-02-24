<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            //Indofood
            [
                'barang_id' => 1,
                'kategori_id' => 1,
                'barang_kode' => 'MKN001',
                'barang_nama' => 'Indomie Goreng',
                'harga_beli' => 2500,
                'harga_jual' => 3000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1,
                'barang_kode' => 'MKN002',
                'barang_nama' => 'Sarimi Ayam',
                'harga_beli' => 2000,
                'harga_jual' => 2500,
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 1,
                'barang_kode' => 'MKN003',
                'barang_nama' => 'Pop Mie Rasa Kari',
                'harga_beli' => 4000,
                'harga_jual' => 5000,
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 1,
                'barang_kode' => 'MKN004',
                'barang_nama' => 'Chitato BBQ',
                'harga_beli' => 8000,
                'harga_jual' => 10000,
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 1,
                'barang_kode' => 'MKN005',
                'barang_nama' => 'Lays Rumput Laut',
                'harga_beli' => 7500,
                'harga_jual' => 9500,
            ],

            // Nabati
            [
                'barang_id' => 6,
                'kategori_id' => 2,
                'barang_kode' => 'MIN001',
                'barang_nama' => 'Teh Pucuk',
                'harga_beli' => 3000,
                'harga_jual' => 4000,
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 2,
                'barang_kode' => 'MIN002',
                'barang_nama' => 'Teh Botol Sosro',
                'harga_beli' => 3500,
                'harga_jual' => 4500,
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 2,
                'barang_kode' => 'MIN003',
                'barang_nama' => 'Fruit Tea Apel',
                'harga_beli' => 4000,
                'harga_jual' => 5000,
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 2,
                'barang_kode' => 'MIN004',
                'barang_nama' => 'Mizone',
                'harga_beli' => 5000,
                'harga_jual' => 6000,
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 2,
                'barang_kode' => 'MIN005',
                'barang_nama' => 'Pocari Sweat',
                'harga_beli' => 7000,
                'harga_jual' => 8500,
            ],
            // Unilever
            [
                'barang_id' => 11,
                'kategori_id' => 4,
                'barang_kode' => 'PKB001',
                'barang_nama' => 'Lifebuoy Sabun Cair',
                'harga_beli' => 12000,
                'harga_jual' => 15000,
            ],
            [
                'barang_id' => 12,
                'kategori_id' => 4,
                'barang_kode' => 'PKB002',
                'barang_nama' => 'Rexona Deo Stick',
                'harga_beli' => 15000,
                'harga_jual' => 18000,
            ],
            [
                'barang_id' => 13,
                'kategori_id' => 4,
                'barang_kode' => 'PKB003',
                'barang_nama' => 'Pepsodent Pasta Gigi',
                'harga_beli' => 9000,
                'harga_jual' => 11000,
            ],
            [
                'barang_id' => 14,
                'kategori_id' => 4,
                'barang_kode' => 'PKB004',
                'barang_nama' => 'Molto Pewangi',
                'harga_beli' => 8000,
                'harga_jual' => 10000,
            ],
            [
                'barang_id' => 15,
                'kategori_id' => 4,
                'barang_kode' => 'PKB005',
                'barang_nama' => 'Sunlight Jeruk',
                'harga_beli' => 7000,
                'harga_jual' => 9000,
            ],
        ];
        DB::table('m_barang')->insert($data);
    }
}
