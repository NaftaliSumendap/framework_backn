<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ListProduk extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'category_id' => 1, // ID kategori 'Gitar' dari tabel 'categories'
                'name' => 'Gitar Akustik Yamaha C40',
                'slug' => 'gitar-yamaha-c40',
                'description' => 'Deskripsi produk yang menarik dan informatif. Produk ini memiliki fitur-fitur unggulan seperti bahan berkualitas tinggi.',
                'price' => 2000000,
                'discount_price' => 1500000,
                'stock' => 50,
                'specifications' => null,
                'brand' => 'Yamaha',
                'is_featured' => 0,
                'image_path' => 'gitar.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1, // ID kategori 'Piano'
                'name' => 'Gitar Yamaha',
                'slug' => 'gitar-yamaha',
                'description' => 'Produk yang menarik dan informatif. Produk ini memiliki fitur-fitur unggulan seperti bahan berkualitas tinggi.',
                'price' => 1500000,
                'discount_price' => 1200000,
                'stock' => 45,
                'specifications' => null,
                'brand' => 'Yamaha',
                'is_featured' => 0,
                'image_path' => 'gitar2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1, // ID kategori 'Drum'
                'name' => 'Gitar Listrik Yamaha',
                'slug' => 'gitar-listrik-yamaha',
                'description' => 'Produk yang menarik dan informatif. Produk ini memiliki fitur-fitur unggulan seperti bahan berkualitas tinggi.',
                'price' => 3100000,
                'discount_price' => 2800000,
                'stock' => 30,
                'specifications' => null,
                'brand' => 'Yamaha',
                'is_featured' => 0,
                'image_path' => 'GitarListrik.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2, // ID kategori 'Alat Musik Tradisional'
                'name' => 'Keyboard Donner',
                'slug' => 'keyboard-donner',
                'description' => 'Deskripsi produk yang menarik dan informatif. Produk ini memiliki fitur-fitur unggulan seperti bahan berkualitas tinggi.',
                'price' => 9500000,
                'discount_price' => 9000000,
                'stock' => 25,
                'specifications' => null,
                'brand' => 'Donner',
                'is_featured' => 0,
                'image_path' => 'piano2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'category_id' => 3, // ID kategori 'Alat Musik Tradisional'
                'name' => 'Drum Set Pearl',
                'slug' => 'drum-set-pearl',
                'description' => 'Deskripsi produk yang menarik dan informatif. Produk ini memiliki fitur-fitur unggulan seperti bahan berkualitas tinggi.',
                'price' => 13500000,
                'discount_price' => 12000000,
                'stock' => 05,
                'specifications' => null,
                'brand' => 'Pearl',
                'is_featured' => 0,
                'image_path' => 'drum.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
