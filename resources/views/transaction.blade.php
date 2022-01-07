@extends('layouts.app')

@section('content')

<div class="container pb-5">
    <h2 class="text-center fw-bolder mt-4 mb-2" style="color: #b86ebb">Transaction History</h2>

    @foreach ($transactions as $transaction)
        <div class="px-4 py-4 mx-auto mt-4" style="border: 1px solid #b86ebb">
            <h4>Transaction Id : {{ $transaction->id }}</h3>
            <div class="d-flex flex-row">
                <h6 class="col-2">Transaction Date : </h6>
                <h6>{{ date('Y-m-d', strtotime($transaction->time))  }}</h6>
            </div>
            <div class="d-flex flex-row">
                <h6 class="col-2">Method : </h6>
                <h6>{{ $transaction->paymentMethod }}</h6>
            </div>
            <div class="d-flex flex-row">
                <h6 class="col-2">Card Number : </h6>
                <h6>xxxx-xxxx-xxxx-{{ substr($transaction->cardNumber, -4) }}</h6>
            </div>
            <div class="d-flex flex-row">
                <h6 class="col-2">User's Name : </h6>
                <h6>{{ $transaction->name }}</h6>
            </div>
            <table class="table table-bordered" style="border: 2px solid #b86ebb">
                <thead style="border: 2px solid #b86ebb">
                <tr>
                    <th class="text-center" scope="col">Furniture's Name</th>
                    <th class="text-center" scope="col">Furniture's Price</th>
                    <th class="text-center" scope="col">Quantity</th>
                    <th class="text-center" scope="col">Total Price For Each Furniture</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($transaction->detail as $detail)
                        <tr>
                            <th class="text-center" scope="row">{{ $detail->name }}</th>
                            <td class="text-center">Rp.{{ $detail->price }}</td>
                            <td class="text-center">{{ $detail->quantity }}</td>
                            <td class="text-center">Rp.{{ $detail->subTotal }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="text-center" colspan="3">Total Price</td>
                        <td class="text-center">Rp.{{ $transaction->grandTotal }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endforeach
</div>

@endsection