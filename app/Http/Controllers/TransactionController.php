<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function buyCurrency(Request $request)
    {
        $userID = auth()->id();
        if ($userID == null) {
            return response(['message' => "unauthenticated"], 401);
        }

        $fields = $request->validate([
            'currency_id' => ['required', 'integer'],
            'amount' => ['required', 'integer']
        ]);

        $price = DB::table('prices')
            ->where('currency_id', '=', $fields['currency_id'])
            ->orderBy('date', 'desc')
            ->first();
        if ($price == null) {
            return response(['message' => "price with id $price does not exist"], 400);
        }

        $newTransaction = Transaction::create([
            'type' => 'buy',
            'date' => now(),
            'amount' => $fields['amount'],
            'user_id' => $userID,
            'value' => $price->value,
            'currency_id' => $fields['currency_id']
         ]);

        if ($newTransaction == null) {
            return response(['message' => "cannot create transaction"], 500);
        }

        // update user fund
        $user = User::find($userID);
        $fundRemaining = $user->fund - $price->value*$fields['amount'];
        $affected = DB::table('users')
            ->where('id', '=', $userID)
            ->update(['fund' => $fundRemaining]);

        if ($affected == null) {
            return response(['message' => "cannot update user"], 500);
        }

        return response('', 204);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function sellCurrency(Request $request)
    {
        $userID = auth()->id();
        if ($userID == null) {
            return response(['message' => "unauthenticated"], 401);
        }

        $fields = $request->validate([
            'currency_id' => ['required', 'integer'],
        ]);

        $resp = DB::transaction(function () use($fields, $userID){
            $currencyID =  $fields['currency_id'];
            $transactions = DB::table('transactions')
                ->where([
                    ['user_id', '=', $userID],
                    ['currency_id', '=', $currencyID],
                    ['type', '=', 'buy'],
                ])->get();
            // dd($transactions->get());
            $price = DB::table('prices')
                ->where('currency_id', '=', $currencyID)
                ->orderBy('date', 'desc')
                ->first();
            if ($price == null) {
                return ['message' => "price with id $price does not exist"];
            }

            // dd($price);
            $value = 0.0;
            foreach ($transactions as $trs) {
                $value += $trs->amount*$price->value;
            }

            // increment user fund
            DB::table('users')
                ->where('id', '=', $userID)
                ->increment('fund', $value);

            // update transactions type to sell
            DB::table('transactions')
                ->where([
                    ['currency_id', '=', $currencyID],
                    ['type', '=', 'buy'],
                ])
                ->update(['type' => 'sell']);
            return null;
        });

        if ($resp != null) {
            return response($resp, 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getTransactions()
    {
        $userID = auth()->id();
        if ($userID == null) {
            return response(['message' => "unauthenticated"], 401);
        }

        $transactions = DB::table('transactions')
            ->where([
                ['user_id', '=', $userID],
            ])
            ->join('currencies', function ($join){
                $join->on('transactions.currency_id', '=', 'currencies.id');
            })
            ->select(['transactions.id', 'name', 'code', 'type', 'amount', 'value','transactions.updated_at as date' ])
            ->orderBy('date', 'desc')
            ->get();

        return response($transactions);
    }
}
