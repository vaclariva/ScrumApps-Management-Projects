<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listWarehouses = ['Gudang 1', 'Gudang 2', 'Gudang 3'];
        foreach($listWarehouses as $listWarehouse){
            Warehouse::create([
                'name' => $listWarehouse
            ]);
        }

    }
}
