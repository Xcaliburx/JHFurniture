@extends('layouts.app')

@section('content')
<div class="container">
    @auth
        <h2 class="text-center fw-bold mt-4" style="color: #b86ebb">Welcome, {{ Auth::user()->name }}</h2>
        <h2 class="text-center fw-bold" style="color: #b86ebb">to JH Furniture</h2>
    @endauth

    @guest
        <h2 class="text-center fw-bold" style="color: #b86ebb">Welcome to JH Furniture</h2>
    @endguest

    <div class="row gx-5 gy-4 mt-4">
        @foreach ($furnitures as $furniture)
            <div class="col-3">
                <a href="">
                    <img class="w-100" style="border: 1px solid #b86ebb" src="{{ Storage::url($furniture->image) }}" height="300" alt="">
                </a>
                <div class="w-100 py-3" style="background-color: #b86ebb">
                    <h5 class="text-center text-white">{{ $furniture->name }}</h5>
                    <p class="text-center text-white">Rp. {{ $furniture->price }}</p>
                    @guest
                    <button class="btn btn-light mx-auto d-block rounded-3 col-6 fw-bold" style="color: #b86ebb">
                        Add To Cart
                    </button>
                    @endguest
                    @auth
                        @if(Auth::user()->roleId == 1)
                            <div class="d-flex flex-row justify-content-md-around">
                                <button type="button" class="btn btn-success rounded-3">Update</button>
                                <button type="button" class="btn btn-danger rounded-3">Delete</button>
                            </div>
                        @else
                            <button class="btn btn-light mx-auto d-block rounded-3" style="color: #b86ebb">
                                Add To Cart
                            </button>
                        @endif
                    @endauth
                    
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
