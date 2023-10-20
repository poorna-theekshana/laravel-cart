@extends('layouts.app')

@section('content')
    @if (session()->has('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    @if (isset($welcomeProducts) && count($welcomeProducts) > 0)
    <div class="row">
        @foreach ($welcomeProducts as $product)
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->pdct_name }}</h5>
                        <p class="card-text">{{ $product->pdct_description }}</p>
                        <p class="card-text">Price: ${{ $product->pdct_price }}</p>
                        <p class="card-text">Available Quantity: {{ $product->pdct_qty }}</p>
                        <p class="card-text">Created: {{ $product->created_at }}</p>
                        <p class="card-text">Last Modified: {{ $product->updated_at }}</p>
                        <a href="{{ route('product.edit', ['product' => $product]) }}" class="btn btn-info">Edit</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p>No products available.</p>
@endif

@endsection
