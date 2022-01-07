<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use AUth;
use App\Models\Cart;
use App\Models\TransactionHeader;
use App\Models\TransactionDetail;
use Carbon\Carbon;

class TransactionController extends Controller
{
    //
    public function checkout(){
        $userId = Auth::user()->id;

        $carts = DB::table('carts')
                 ->join('furniture', 'carts.furnitureId', '=', 'furniture.id')
                 ->where('carts.userId', $userId)
                 ->get();

        $total = 0;
        foreach($carts as $cart){
            $total += ($cart->quantity * $cart->price);
        }

        $data =  [
            'carts' => $carts,
            'total' => $total
        ];

        return view('checkout', $data);
    }

    public function transaction(Request $request){
        $userId = Auth::user()->id;

        $request->validate([
            'payment' => 'required',
            'card-number' => 'required|numeric|digits:16'
        ]);

        $carts = DB::table('carts')
                 ->join('furniture', 'carts.furnitureId', '=', 'furniture.id')
                 ->where('carts.userId', $userId)
                 ->get();

        $grandTotal = 0;
        foreach($carts as $cart){
            $grandTotal += ($cart->quantity * $cart->price);
        }

        $transaction = TransactionHeader::create([
            'userId' => $userId,
            'time' => Carbon::now()->toDateTimeString(),
            'paymentMethod' => $request->input('payment'),
            'cardNumber' => $request->input('card-number'),
            'grandTotal' => $grandTotal
        ]);

        foreach($carts as $cart){
            TransactionDetail::create([
                'transactionHeaderId' => $transaction->id,
                'furnitureId' => $cart->furnitureId,
                'quantity' => $cart->quantity,
                'subTotal' => ($cart->quantity * $cart->price)
            ]);
        }
        Cart::where('userId', $userId)->delete();

        return redirect('/user/transaction');
    }

    public function viewTransaction(){
        $userId = Auth::user()->id;

        $transactions = DB::table('transaction_headers')
                        ->join('users', 'users.id', '=', 'transaction_headers.userId')
                        ->where('transaction_headers.userId', $userId)
                        ->select('transaction_headers.*', 'users.name')
                        ->get();

        foreach($transactions as $transaction){
            $detail = DB::table('transaction_details')
                      ->join('furniture', 'furniture.id', '=', 'transaction_details.furnitureId')
                      ->where('transaction_details.transactionHeaderId', $transaction->id)
                      ->get();

            $transaction->detail = $detail;
        }

        return view('transaction', ['transactions' => $transactions]);
    }

    public function allTransaction(){
        $transactions = DB::table('transaction_headers')
                        ->join('users', 'users.id', '=', 'transaction_headers.userId')
                        ->select('transaction_headers.*', 'users.name')
                        ->get();

        foreach($transactions as $transaction){
            $detail = DB::table('transaction_details')
                        ->join('furniture', 'furniture.id', '=', 'transaction_details.furnitureId')
                        ->where('transaction_details.transactionHeaderId', $transaction->id)
                        ->get();

            $transaction->detail = $detail;
        }

        return view('transaction', ['transactions' => $transactions]);
    }
}
