<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Price;
use Illuminate\Support\Facades\DB;
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
        $Currencies_code = [
            'Bitcoin' => 'BTC',
            'Ethereum' => 'ETH',
            'Ripple' => 'XRP',
            'Bitcoin Cash' => 'BCH',
            'Cardano' => 'ADA',
            'Litecoin' => 'LTC',
            'NEM' => 'XEM',
            'Stellar' => 'XLM',
            'IOTA' =>  'IOTA',
            'Dash' => 'DASH'
        ];
        foreach ($Currencies_code as $key => $value) {
            DB::table('currencies')->insert([
                'name' => $key,
                'code' => $value,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
