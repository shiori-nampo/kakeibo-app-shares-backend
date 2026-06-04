<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => '住居費', 'type' => 'fixed'],
            ['name' => '光熱費', 'type' => 'fixed'],
            ['name' => '通信費', 'type' => 'fixed'],
            ['name' => '保険料', 'type' => 'fixed'],
            ['name' => '税金', 'type' => 'fixed'],

            ['name' => '食費', 'type' => 'variable'],
            ['name' => '外食費', 'type' => 'variable'],
            ['name' => '日用品', 'type' => 'variable'],
            ['name' => '交通費', 'type' => 'variable'],
            ['name' => 'ショッピング', 'type' => 'variable'],
            ['name' => '医療費', 'type' => 'variable'],
            ['name' => '交際費', 'type' => 'variable'],
            ['name' => '趣味', 'type' => 'variable'],
            ['name' => 'キッズ', 'type' => 'variable'],
            ['name' => '特別費', 'type' => 'variable'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
