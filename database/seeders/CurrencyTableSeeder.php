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
        Currency::factory()->count(10)->create()->each(function ($currency){

            $prices = Price::pluck('id')->shuffle()->slice(0, rand(1, 3))->all();
            $currency->prices()->attach($prices);

            $currency->save();
        });
    }
}
