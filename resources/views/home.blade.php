@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container">
    @auth
        <h2 class="text-center fw-bold mt-4" style="color: #b86ebb">Welcome, {{ Auth::user()->name }}</h2>
        <h2 class="text-center fw-bold" style="color: #b86ebb">to JH Furniture</h2>
    @endauth

    @guest
        <h2 class="text-center fw-bold mt-4" style="color: #b86ebb">Welcome to JH Furniture</h2>
    @endguest

    <div class="row gx-5 gy-4 mt-4">
        @if(count($furnitures) == 0)
            <h1  style="color: #b86ebb">There is no data</h1>
        @endif
        @foreach ($furnitures as $furniture)
            <div class="col-3">
                <a href="/furniture/detail/{{ $furniture->id }}">
                    <img class="w-100" style="border: 1px solid #b86ebb" src="{{ Storage::url($furniture->image) }}" height="300" alt="">
                </a>
                <div class="w-100 py-3" style="background-color: #b86ebb">
                    <h5 class="text-center text-white">{{ $furniture->name }}</h5>
                    <p class="text-center text-white">Rp. {{ $furniture->price }}</p>
                    @guest
                    <a href="/login" class="btn btn-light mx-auto d-block rounded-3 col-6 fw-bold" style="color: #b86ebb">
                        Add To Cart
                    </a>
                    @endguest
                    @auth
                        @if(Auth::user()->roleId == 1)
                            <div class="d-flex flex-row justify-content-md-around">
                                <a class="btn btn-success rounded-3" href="/admin/furniture/edit/{{ $furniture->id }}">Update</a>
                                <form action="{{ url('/admin/furniture/delete', $furniture->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger rounded-3">Delete</button>
                                </form>
                            </div>
                        @else
                            <form action="{{ url('/user/cart/add', $furniture->id ) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-light mx-auto d-block rounded-3" style="color: #b86ebb">
                                    Add To Cart
                                </button>
                            </form>
                        @endif
                    @endauth
                    
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
