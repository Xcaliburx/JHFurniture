@extends('layouts.app')

@section('content')
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<div class="container pb-5">
    <h2 class="text-center fw-bolder mt-4 mb-5" style="color: #b86ebb">Checkout</h2>

    @foreach ($carts as $cart)
        <div class="d-flex flex-row justify-content-around mt-5">
            <img style="border: 1px solid #b86ebb" src="{{ Storage::url($cart->image) }}" width="250" alt="">
            <h3 class="my-auto">{{ $cart->name }}</h3>
            <h3 class="my-auto">Rp.{{ $cart->price }}</h3>
            <h3 class="my-auto">{{ $cart->quantity}} item(s)</h3>
            <h3 class="my-auto">Rp.{{ $cart->price * $cart->quantity}}</h3>
        </div>
    @endforeach

    <h2 class="text-center mt-5">Total : Rp.{{ $total }}</h2>

    <form class="mx-auto w-50" action="{{ url('user/transaction/create') }}" method="POST">
        @csrf

        <div class="d-flex flex-row gap-5 mt-3">
            <label class="col-4" for="">Payment Method</label>
            <div class="d-flex flex-row gap-2 align-items-center">
                <input id="credit" type="radio" name="payment" value="Credit" required>
                <label for="credit">Credit</label>
            </div>
            <div class=" d-flex flex-row gap-2 align-items-center">
                <input id="debit" type="radio" name="payment" value="Debit" required>
                <label for="debit">Debit</label>
            </div>
        </div>

        <div class="d-flex flex-row mt-3 align-items-center">
            <label class="col-4" for="card">Card Number</label>

            <div class="w-100">
                <input class="form-control @error('card-number') is-invalid @enderror" type="number" name="card-number" id="card-number" placeholder="Enter your card number" required>
                @error('card-number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn col-4 text-white d-block mx-auto mt-3 fs-4 rounded-3" style="background-color: #b86ebb">Checkout</button>
    </form>
</div>

@endsection