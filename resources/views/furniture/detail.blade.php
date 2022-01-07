@extends('layouts.app')

@section('content')

<div class="container pb-5">
    <h2 class="text-center fw-bold mt-4" style="color: #b86ebb">{{ $furniture->name }}</h2>

    <div class="d-flex flex-row justify-content-evenly mt-5 pt-5">
        <img src="{{ Storage::url($furniture->image) }}" width="400" height="400" alt="">

        <div class="py-5 mt-5 w-25" style="color: #b86ebb">
            <div class="row">
                <h3 class="fw-bold col-6">Name :</h3>
                <h3 class="fw-bold col-5 text-md-end">{{ $furniture->name }}</h3>
            </div>
            
            <div class="row mt-3">
                <h3 class="fw-bold col-6">Price :</h3>
                <h3 class="fw-bold col-5 text-md-end">Rp. {{ $furniture->price }}</h3>
            </div>
            
            <div class="row mt-3">
                <h3 class="fw-bold col-6">Type :</h3>
                <h3 class="fw-bold col-5 text-md-end">{{ $furniture->type }}</h3>
            </div>

            <div class="row mt-3">
                <h3 class="fw-bold col-6">Color :</h3>
                <h3 class="fw-bold col-5 text-md-end">{{ $furniture->color }}</h3>
            </div>
        </div>
    </div>

    <div class="d-flex flex-row justify-content-center mt-5 gap-5">
        @auth
            @if(Auth::user()->roleId == 1)
                <a href="{{ url()->previous() }}" class="btn py-3 px-4 text-white fs-4 rounded-3" style="background-color: #b86ebb">Previous</a>
                <a href="/admin/furniture/edit/{{ $furniture->id }}" class="btn btn-success py-3 px-4 text-white fs-4 rounded-3">Update</a>
                <form action="{{ url('/admin/furniture/delete', $furniture->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger py-3 px-4 text-white fs-4 rounded-3">Delete</button>
                </form>
            @else
                <a href="{{ url()->previous() }}" class="btn py-3 px-4 text-white fs-4 rounded-3 me-5" style="background-color: #b86ebb">Previous</a>
                <form action="{{ url('/user/cart/add', $furniture->id ) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn py-3 px-4 text-white fs-4 rounded-3 ms-5" style="color: #b86ebb">
                        Add To Cart
                    </button>
                </form>
            @endif
        @endauth

        @guest
            <a href="{{ url()->previous() }}" class="btn py-3 px-4 text-white fs-4 rounded-3 me-5" style="background-color: #b86ebb">Previous</a>
            <a href="/login" class="btn py-3 px-4 text-white fs-4 rounded-3 ms-5" style="background-color: #b86ebb">Add To Cart</a>
        @endguest
        
    </div>
</div>

@endsection