@extends('layouts.app')

@section('content')

<div class="container pb-5">
    <h2 class="text-center fw-bolder mt-4 mb-5" style="color: #b86ebb">Cart</h2>

    @if(count($carts) == 0)
        <h3 class="text-center">There is no item on cart</h3>
    @endif
    @foreach ($carts as $cart)
        <div class="d-flex flex-row justify-content-around mt-5">
            <img style="border: 1px solid #b86ebb" src="{{ Storage::url($cart->image) }}" width="250" alt="">
            <h3 class="my-auto">{{ $cart->name }}</h3>
            <h3 class="my-auto">Rp.{{ $cart->price }}</h3>
            <h3 class="my-auto">{{ $cart->quantity}} item(s)</h3>
            <h3 class="my-auto">Rp.{{ $cart->price * $cart->quantity}}</h3>
            <div class="my-auto d-flex flex-row">
                <form action="{{ url('/user/cart/qty/reduce', $cart->id) }}" method="POST">
                    @csrf
                    <button type="submit" style="background-color: #b86ebb" class="btn px-5 text-white me-2" @if($cart->quantity <= 1) disabled @endif>-</button>
                </form>
                
                <form action="{{ url('/user/cart/qty/add', $cart->id) }}" method="POST">
                    @csrf
                    <button type="submit" style="background-color: #b86ebb" class="btn px-5 text-white" >+</button>
                </form>

            </div>
        </div>
    @endforeach

    <h2 class=" text-center mt-5">Total : Rp.{{ $total }}</h2>

    @if($total != 0)
        <a href="/user/checkout" class="btn text-white d-block mx-auto mt-4 fs-4 rounded-5" style="background-color: #b86ebb; width:fit-content">Proceed To Checkout</a>
    @endif
</div>

@endsection