<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ListKategori extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Gitar',
                'slug' => 'gitar',
                'description' => 'Pilihan Gitar yang terbaik',
                'image' => null, // Jika tidak ada gambar, bisa di-set NULL
            ],
            [
                'name' => 'Keyboard',
                'slug' => 'kerboard',
                'description' => 'Pilihan Keybpard yang terbaik',
                'image' => null,
            ],
            [
                'name' => 'Drum',
                'slug' => 'drum',
                'description' => 'Pilihan drum yang terbaik',
                'image' => null,
            ],
            [
                'name' => 'Alat Musik Tradisional',
                'slug' => 'alat-musik-tradisional',
                'description' => 'Pilihan alat musik tradisional yang terbaik',
                'image' => null,
            ]
        ]);
    }
}
