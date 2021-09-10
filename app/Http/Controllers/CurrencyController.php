<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    protected $paginate = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $currencies = DB::table('currencies')->get();

       $resp = array();
        foreach ($currencies as $currency) {
            $price = Price::where([
                ['currency_id', '=', $currency->id],
            ])
            ->orderBy('date','desc')
            ->first();
            $priceValue = 0;
            $priceDate = '';
            if ($price) {
                $priceValue = $price->value;
                $priceDate = $price->date;
            }
            array_push($resp, [
                'id'=> $currency->id,
                'name' => $currency->name,
                'code' => $currency->code,
                'price' => $priceValue,
                'price_date' => $priceDate,
                ]);
        }
        return response()->json($resp);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->isJson()) {
            response(['message' => 'body is required'], 400);
        }
        $fields = $request->validate([
            'name' => ['required', 'string'],
            'code' => ['required', 'string'],
            'price' => ['required', 'numeric'],
        ]);

        $newCurrency = Currency::create(
            [
                'name' => $fields['name'],
                'code' => $fields['code']
            ]
        );
        Price::create(
            [
                'value' => $fields['price']
            ]
        );
        return response(['id'=> $newCurrency->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCurrencyById($id)
    {
        $currency = Currency::find($id);
        if (!$currency) {
            return response(['message' => "currency with id $id is not found"], 400);
        }
        $pricesDB = Price::where([
            ['currency_id', '=', $currency->id],
        ])
            ->orderBy('date','desc')
            ->get();

        $prices = array();
        foreach ($pricesDB as $price) {
            array_push($prices, [
                'value' => $price->value,
                'date' => $price->date,
            ]);
        }

        return response([
            'id'=> $currency->id,
            'name' => $currency->name,
            'code' => $currency->code,
            'prices' => $prices,
        ]);
    }
}
