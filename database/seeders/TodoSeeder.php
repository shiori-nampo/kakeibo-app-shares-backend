<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Todo;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $todos = [
            [
                'group_id' => 1,
                'user_id' => 2,
                'completed_by' => null,
                'title' => '郵便局へ行く',
                'type' => 'todo',
                'is_completed' => false,
            ],


            [
                'group_id' => 2,
                'user_id' => 3,
                'completed_by' => 3,
                'title' => '書類書く',
                'type' => 'todo',
                'is_completed' => true,
            ],

        ];

        foreach ($todos as $todo) {
            Todo::create($todo);
        }
    }
}
