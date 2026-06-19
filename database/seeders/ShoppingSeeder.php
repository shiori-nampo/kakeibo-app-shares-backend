<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Todo;

class ShoppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shoppings = [
            [
                'group_id' => 2,
                'user_id' => 4,
                'completed_by' => null,
                'title' => '牛乳',
                'type' => 'shopping',
                'is_completed' => false,
            ],

            [
                'group_id' => 1,
                'user_id' => 2,
                'completed_by' => null,
                'title' => '卵',
                'type' => 'shopping',
                'is_completed' => false,
            ],
        ];

        foreach ($shoppings as $shopping) {
            Todo::create($shopping);
        }
    }
}
