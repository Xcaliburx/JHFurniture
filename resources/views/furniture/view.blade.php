@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center fw-bold mt-4" style="color: #b86ebb">View Furniture</h2>

    <form class="mt-4" action="{{ url('/furniture/search') }}" method="POST">
        @csrf

        <div class="d-flex flex-row gap-2 justify-content-end">
            <input class="form-control w-25" type="text" name="search" placeholder="Search by furniture's name">
            <button type="submit" class="btn text-white" style="background-color: #b86ebb">Search</button>
        </div>
    </form>

    <div class="row gx-5 gy-4 mt-2">
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
                                <a href="/admin/furniture/edit/{{ $furniture->id }}" class="btn btn-success rounded-3">Update</a>
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
    <ul class="pagination">
        <div class="d-block mx-auto mt-5">
            @if($furnitures->previousPageUrl())
                <a class="fs-4" href="{{$furnitures->previousPageUrl()}}" style="text-decoration: none; color:#b86ebb"><< Previous </a>
            @endif
            @if($furnitures->nextPageUrl())
                <a class="fs-4" href="{{$furnitures->nextPageUrl()}}" style="text-decoration: none; color:#b86ebb"> Next >></a>
            @endif
        </div>
    </ul>
</div>
@endsection
