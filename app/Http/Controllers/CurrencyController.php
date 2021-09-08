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
            ->orderBy('created_at','desc')
            ->first();
            $priceValue = 0;
            $priceDate = '';
            if ($price) {
                $priceValue = $price->value;
                $priceDate = $price->created_at;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'code' => ['required'],
        ]);
        return Currency::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currency = Currency::find($id);
        if (!$currency) {
            return response(['message' => "currency with id $id is not found"], 400);
        }
        $pricesDB = Price::where([
            ['currency_id', '=', $currency->id],
        ])
            ->orderBy('created_at','asc')
            ->get();

        $prices = array();
        foreach ($pricesDB as $price) {
            array_push($prices, [
                'value' => $price->value,
                'date' => $price->created_at,
            ]);
        }

        return response([
            'id'=> $currency->id,
            'name' => $currency->name,
            'code' => $currency->code,
            'prices' => $prices,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
