<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Price;
use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::factory(10)->create();
    }
}
