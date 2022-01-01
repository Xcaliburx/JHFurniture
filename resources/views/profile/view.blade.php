@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="text-center fw-bolder mt-4" style="color: #b86ebb">{{ $user->name }}'s Profile</h2>

    <div class=" mt-5">
        <div class="d-flex flex-row justify-content-center mt-3">
            <h4 class="fw-bold col-2">Full Name</h4>
            <h4 class="fw-bold col-2">{{ $user->name }}</h4>
        </div>
        
        <div class="d-flex flex-row justify-content-center mt-3">
            <h4 class="fw-bold col-2">Email</h4>
            <h4 class="fw-bold col-2">{{ $user->email }}</h4>
        </div>

        @if(Auth::user()->roleId == 2)
            <div class="d-flex flex-row justify-content-center mt-3">
                <h4 class="fw-bold col-2">Address</h4>
                <h4 class="fw-bold col-2">{{ $user->address }}</h4>
            </div>

            <div class="d-flex flex-row justify-content-center mt-3">
                <h4 class="fw-bold col-2">Gender</h4>
                <h4 class="fw-bold col-2">{{ $user->gender }}</h4>
            </div>
        @endif
        
        <div class="d-flex flex-row justify-content-center mt-3">
            <h4 class="fw-bold col-2">Role</h4>
            <h4 class="fw-bold col-2">@if($user->roleId == 1) Admin @else Member @endif</h4>
        </div>

        <div class="d-flex flex-row mt-4 justify-content-center gap-5">
            <a class="btn text-white" style="background-color: #b86ebb" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

            @if(Auth::user()->roleId == 1)
                <button class="btn text-white" style="background-color: #b86ebb">View All User's Transaction</button>
            @else
                <button class="btn text-white" style="background-color: #b86ebb">View Transaction History</button>
            @endif
            <a href="/profile/update" class="btn text-white" style="background-color: #b86ebb">Update Profile</a>
        </div>
    </div>
    
</div>

@endsection