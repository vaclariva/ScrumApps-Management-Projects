<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['name' => 'Gram', 'desc' => 'Deskripsi Gram'],
            ['name' => 'Kilogram', 'desc' => 'Deskripsi Kilogram'],
            ['name' => 'Ons', 'desc' => 'Deskripsi Ons'],
            ['name' => 'Kuintal', 'desc' => 'Deskripsi Kuintal'],
            ['name' => 'Pcs', 'desc' => 'Deskripsi Pcs'],
            ['name' => 'Liter', 'desc' => 'Deskripsi Pcs'],
            ['name' => 'Paket', 'desc' => 'Deskripsi Pcs'],
            ['name' => 'Unit', 'desc' => 'Deskripsi Pcs'],
            ['name' => 'Set', 'desc' => 'Deskripsi Pcs'],
            ['name' => 'Meter', 'desc' => 'Deskripsi Pcs'],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
