<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class TransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Transaction::factory()->count(20)->create();
        Transaction::factory(30)->create();
    }
}
