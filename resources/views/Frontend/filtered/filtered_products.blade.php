@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <!-- Your sidebar content goes here -->
                @include('frontend.layouts.menu_left')
            </div>
            <div class="col-md-9">
                <h1>Filtered Products</h1>
                <div id="filtered-products">
                    <!-- Filtered products will be displayed here -->
                    @foreach($filteredProducts as $product)
                        <div class="col-md-4">
                            <div class="product">
                                <!-- Display product details here -->
                                <h2>{{ $product->name }}</h2>
                                <p>Price: ${{ $product->price }}</p>
                                <!-- Add more product details as needed -->
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
