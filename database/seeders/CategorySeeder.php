<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Air Terjun',
            'Danau',
            'Bukit',
            'Sungai',
            'Wisata Alam',
        ];

        foreach ($data as $nama) {
            Category::updateOrCreate(
                ['slug' => Str::slug($nama)],
                ['nama' => $nama]
            );
        }
    }
}
