@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Produk</h4>
    <div class="row">

        @foreach($products as $product)
        <div class="card col-3 shadow-sm text-center">
            <div class="row justify-content-center mt-md-3">
                <img src="{{ asset('storage/assets/uploads/'.$product->image) }}" class="card-img-top img-fluid" style="max-width: 200px; max-height: 200px; object-fit: scale-down;" alt="...">
            </div>

            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text"> <strong> Rp {{ $product->price }} </strong></p>
                <p class="text-left">{{ $product->description }}</p>

                <button class="btn btn-primary">Beli</button>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection