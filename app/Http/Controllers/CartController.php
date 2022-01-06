<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Auth;
use DB;

class CartController extends Controller
{
    //
    public function addCart($id){
        $userId = Auth::user()->id;

        Cart::create([
            'userId' => $userId,
            'furnitureId' => $id,
            'quantity' => 1
        ]);

        return redirect('/home')->with('success', 'Add to Cart Success!');
    }

    public function view(){
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

        return view('cart', $data);
    }

    public function addQty($id){
        $cart = Cart::where('id', $id)->first();
        Cart::where('id', $id)->update([
            'quantity' => $cart->quantity + 1
        ]);

        return redirect('/user/cart');
    }

    public function reduceQty($id){
        $cart = Cart::where('id', $id)->first();
        if($cart->quantity > 1){
            Cart::where('id', $id)->update([
                'quantity' => $cart->quantity - 1
            ]);
        }
        return redirect('/user/cart');
    }
}
