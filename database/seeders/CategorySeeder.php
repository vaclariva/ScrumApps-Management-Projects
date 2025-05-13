<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Uncategories', 'desc' => ''],
            ['name' => 'Alat Pertanian', 'desc' => ''],
            ['name' => 'Pupuk', 'desc' => ''],
            ['name' => 'Pupuk Organik', 'desc' => ''],
            ['name' => 'Pupuk Anorganik', 'desc' => ''],
            ['name' => 'Pestisida', 'desc' => ''],
            ['name' => 'Bibit', 'desc' => ''],
            // Kategori tambahan
            ['name' => 'Irigasi', 'desc' => 'Sistem pengairan dan perlengkapannya.'],
            ['name' => 'Perawatan Tanaman', 'desc' => 'Produk untuk merawat dan menjaga kesehatan tanaman.'],
            ['name' => 'Pupuk Khusus', 'desc' => 'Pupuk yang diformulasi untuk tanaman tertentu.'],
            ['name' => 'Peralatan Kebun', 'desc' => 'Alat untuk berkebun dan pemeliharaan kebun.'],
            ['name' => 'Bahan Tanaman', 'desc' => 'Bahan-bahan pendukung untuk pertumbuhan tanaman.'],
            ['name' => 'Kendaraan Pertanian', 'desc' => 'Kendaraan dan mesin untuk mendukung kegiatan pertanian.'],
            ['name' => 'Pakaian Pertanian', 'desc' => 'Pakaian khusus untuk kegiatan pertanian.'],

            // Kategori tambahan lainnya
            ['name' => 'Sistem Pertanian Terpadu', 'desc' => 'Metode pertanian yang mengintegrasikan berbagai jenis tanaman.'],
            ['name' => 'Teknologi Pertanian', 'desc' => 'Inovasi dan teknologi terbaru dalam pertanian.'],
            ['name' => 'Budidaya Hidroponik', 'desc' => 'Produk dan perlengkapan untuk budidaya tanaman tanpa tanah.'],
            ['name' => 'Tanaman Hias', 'desc' => 'Bibit dan produk untuk tanaman hias.'],
            ['name' => 'Pertanian Berkelanjutan', 'desc' => 'Praktik dan produk untuk pertanian yang ramah lingkungan.'],
            ['name' => 'Pengolahan Hasil Pertanian', 'desc' => 'Produk dan alat untuk mengolah hasil pertanian.'],
            ['name' => 'Bahan Pembantu Pertanian', 'desc' => 'Bahan tambahan untuk meningkatkan hasil pertanian.'],
            ['name' => 'Pengendalian Hama', 'desc' => 'Produk untuk mengendalikan hama dan penyakit tanaman.'],
            ['name' => 'Kompos', 'desc' => 'Produk kompos untuk meningkatkan kesuburan tanah.'],
            ['name' => 'Fermentasi Tanaman', 'desc' => 'Produk untuk proses fermentasi tanaman.'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
