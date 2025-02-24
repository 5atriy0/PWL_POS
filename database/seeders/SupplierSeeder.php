<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'supplier_id' => 1,
                'supplier_kode' => 'IND',
                'supplier_nama' => 'Indofood',
                'supplier_alamat' => 'Malang',
            ],
            [
                'supplier_id' => 2,
                'supplier_kode' => 'NBT',
                'supplier_nama' => 'Nabati',
                'supplier_alamat' => 'Surabaya'
            ],
            [
                'supplier_id' => 3,
                'supplier_kode' => 'UNV',
                'supplier_nama' => 'Unilever',
                'supplier_alamat' => 'Jakarta',
            ],
        ];
        DB::table('m_supplier')->insert($data);
    }
}
