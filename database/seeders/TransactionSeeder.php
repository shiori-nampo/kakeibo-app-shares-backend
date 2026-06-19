<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = [
            [
                'group_id' => 1,
                'user_id' => 1,
                'category_id' => 8,
                'amount' => 4500,
                'type' => 'expense',
                'date' => '2026-06-01',
                'memo' => '事務所のコピー用紙立替代',
            ],

            [
                'group_id' => 1,
                'user_id' => 2,
                'category_id' => 2,
                'amount' => 8200,
                'type' => 'expense',
                'date' => '2026-06-02',
                'memo' => '5月分の電気代',
            ],

            [
                'group_id' => 1,
                'user_id' => 1,
                'category_id' => 16,
                'amount' => 200000,
                'type' => 'income',
                'date' => '2026-06-01',
                'memo' => '今月の給料',
            ],

            [
                'group_id' => null,
                'user_id' => 1,
                'category_id' => 12,
                'amount' => 5800,
                'type' => 'expense',
                'date' => '2026-06-03',
                'memo' => '欲しかった技術書代',
            ],

        ];

        foreach ($transactions as $transaction) {
            Transaction::create($transaction);
        }
    }
}
