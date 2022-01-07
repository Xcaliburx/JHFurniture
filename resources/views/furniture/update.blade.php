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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center fw-bold mt-4" style="color: #b86ebb">{{ __('Update Furniture') }}</h2>

            <form class="mt-4 ms-5" method="POST" action="{{ url('/admin/furniture/update', $furniture->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-start fw-bold">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $furniture->name }}" placeholder="Enter furniture's name" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="price" class="col-md-4 col-form-label text-md-start fw-bold">{{ __('Price') }}</label>

                    <div class="col-md-6">
                        <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $furniture->price }}" placeholder="Enter furniture's price" required autocomplete="price">

                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="typeId" class="col-md-4 col-form-label text-md-start fw-bold">{{ __('Type') }}</label>

                    <div class="col-md-6">
                        <select id="typeId" class="form-select @error('typeId') is-invalid @enderror" name="typeId" required>
                            <option disabled selected value="">Choose furniture's type</option>
                            @foreach ($types as $type)
                                <option @if($type->id == $furniture->typeId) selected @endif value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                          </select>

                        @error('typeId')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="colorId" class="col-md-4 col-form-label text-md-start fw-bold">{{ __('Color') }}</label>

                    <div class="col-md-6">
                        <select id="colorId" class="form-select @error('colorId') is-invalid @enderror" name="colorId" required>
                            <option disabled selected value="">Choose furniture's color</option>
                            @foreach ($colors as $color)
                                <option @if($color->id == $furniture->colorId) selected @endif value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                          </select>

                        @error('colorId')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="image" class="col-md-4 col-form-label text-md-start fw-bold">{{ __('Image') }}</label>

                    <div class="col-md-6">
                        <input id="image" type="file" name="image" class="form-control @error('image') is-invalid @enderror" placeholder="No file chosen">

                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-5" style="background-color: #b86ebb">
                            {{ __('Update Furniture') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
