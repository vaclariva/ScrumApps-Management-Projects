<?php

namespace Database\Seeders;

use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try{
            DB::beginTransaction();

            $listProducts = [
                ['name' => 'Pupuk Kandang', 'type' => 'Pengembangan', 'has_variant' => true, 'categories' => ['Pupuk', 'Pupuk Organik'], 'unit' => 'Kilogram'],
                ['name' => 'Pupuk Hijau', 'type' => 'Pengembangan', 'has_variant' => true, 'categories' => ['Pupuk Organik'], 'unit' => 'Kilogram'],
                ['name' => 'Pupuk Urea', 'type' => 'Popular', 'has_variant' => false, 'categories' => ['Pupuk Anorganik'], 'unit' => 'Kilogram'],
                ['name' => 'Cangkul', 'type' => 'Popular', 'has_variant' => false, 'categories' => ['Alat Pertanian'], 'unit' => 'Pcs'],
                ['name' => 'Bibit Cabai', 'type' => 'Pengembangan', 'has_variant' => true, 'categories' => ['Bibit'], 'unit' => 'Ons'],

                // Produk dengan kategori tambahan
                ['name' => 'Selang Irigasi', 'type' => 'Pengembangan', 'has_variant' => true, 'categories' => ['Irigasi'], 'unit' => 'Meter'],
                ['name' => 'Alat Semprot Tanaman', 'type' => 'Popular', 'has_variant' => false, 'categories' => ['Perawatan Tanaman', 'Pengendalian Hama'], 'unit' => 'Pcs'],
                ['name' => 'Pupuk Kacang Tanah', 'type' => 'Pengembangan', 'has_variant' => false, 'categories' => ['Pupuk Khusus', 'Pupuk Organik'], 'unit' => 'Kilogram'],
                ['name' => 'Gunting Kebun', 'type' => 'Popular', 'has_variant' => false, 'categories' => ['Peralatan Kebun', 'Alat Pertanian'], 'unit' => 'Pcs'],
                ['name' => 'Media Tanam', 'type' => 'Pengembangan', 'has_variant' => false, 'categories' => ['Bahan Tanaman'], 'unit' => 'Kilogram'],
                ['name' => 'Traktor Mini', 'type' => 'Popular', 'has_variant' => false, 'categories' => ['Kendaraan Pertanian', 'Sistem Pertanian Terpadu'], 'unit' => 'Unit'],
                ['name' => 'Sepatu Boots', 'type' => 'Pengembangan', 'has_variant' => false, 'categories' => ['Pakaian Pertanian'], 'unit' => 'Pcs'],
                ['name' => 'Alat Pengendali Hama', 'type' => 'Popular', 'has_variant' => false, 'categories' => ['Pengendalian Hama', 'Perawatan Tanaman'], 'unit' => 'Pcs'],
                ['name' => 'Pupuk Kompos', 'type' => 'Pengembangan', 'has_variant' => false, 'categories' => ['Kompos'], 'unit' => 'Kilogram'],
                ['name' => 'Fermentasi Pupuk Cair', 'type' => 'Popular', 'has_variant' => false, 'categories' => ['Fermentasi Tanaman'], 'unit' => 'Liter'],
                ['name' => 'Sistem Hidroponik', 'type' => 'Pengembangan', 'has_variant' => true, 'categories' => ['Budidaya Hidroponik', 'Teknologi Pertanian'], 'unit' => 'Set'],
                ['name' => 'Bibit Bunga Hias', 'type' => 'Popular', 'has_variant' => true, 'categories' => ['Tanaman Hias'], 'unit' => 'Paket'],
                ['name' => 'Mesin Pengolah Padi', 'type' => 'Pengembangan', 'has_variant' => true, 'categories' => ['Pengolahan Hasil Pertanian', 'Kendaraan Pertanian'], 'unit' => 'Unit'],
                ['name' => 'Kompos Cair', 'type' => 'Popular', 'has_variant' => false, 'categories' => ['Kompos'], 'unit' => 'Liter'],
                ['name' => 'Bahan Aditif Tanaman', 'type' => 'Pengembangan', 'has_variant' => false, 'categories' => ['Uncategories'], 'unit' => 'Kilogram'],

                // Produk dengan kombinasi kategori yang bervariasi
                ['name' => 'Pompa Air Irigasi', 'type' => 'Popular', 'has_variant' => false, 'categories' => ['Irigasi'], 'unit' => 'Unit'],
                ['name' => 'Mesin Penyemprot Tanaman', 'type' => 'Pengembangan', 'has_variant' => false, 'categories' => ['Perawatan Tanaman'], 'unit' => 'Unit'],
                ['name' => 'Pupuk Kelapa Sawit', 'type' => 'Pengembangan', 'has_variant' => false, 'categories' => ['Pupuk Khusus', 'Pupuk Anorganik'], 'unit' => 'Kilogram'],
                ['name' => 'Gergaji Tangan Kebun', 'type' => 'Popular', 'has_variant' => false, 'categories' => ['Peralatan Kebun'], 'unit' => 'Pcs'],
                ['name' => 'Pot Tanaman Hias', 'type' => 'Pengembangan', 'has_variant' => false, 'categories' => ['Tanaman Hias'], 'unit' => 'Pcs'],
                ['name' => 'Bibit Sayuran Hidroponik', 'type' => 'Pengembangan', 'has_variant' => true, 'categories' => ['Budidaya Hidroponik'], 'unit' => 'Paket'],
                ['name' => 'Pestisida Cair', 'type' => 'Popular', 'has_variant' => false, 'categories' => ['Pestisida', 'Pengendalian Hama'], 'unit' => 'Liter'],
                ['name' => 'Mesin Pembajak Sawah', 'type' => 'Popular', 'has_variant' => false, 'categories' => ['Kendaraan Pertanian'], 'unit' => 'Unit'],
            ];


            foreach($listProducts as $listProduct){
                $product = Product::create([
                    'name' => $listProduct['name'],
                    'type' => $listProduct['type'],
                    'has_variant' => $listProduct['has_variant'],
                ]);

                foreach($listProduct['categories'] as $category){
                    $product->productCategories()->create([
                        'category_id' => Category::where('name', $category)->first()->id
                    ]);
                }

                $loop = $listProduct['has_variant'] ? rand(2,5) : 1;
                for($i=1; $i<=$loop; $i++){
                    $productVariant = $product->productVariants()->create([
                        'unit_id' => Unit::where('name', $listProduct['unit'])->first()->id,
                        'name' => $listProduct['has_variant'] ? 'Grade ' . chr(64 + $i) : null , // 65 adalah kode ASCII untuk 'A'
                    ]);

                    $businessModels = ['b2b', 'b2c'];

                    foreach($businessModels as $businessModel){
                        $price = rand(100, 300) * 1000;
                        $productVariant->productVariantPrices()->create([
                            'business_model' => $businessModel,
                            'price' => $price,
                            'is_visible' => rand(0, 1),
                            'star_price' => $businessModel == 'b2b' ? $price - 20000 : null
                        ]);
                    }
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            info($th);
            DB::rollback();
            abort(500);
        }

    }
}
