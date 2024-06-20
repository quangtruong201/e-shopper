@extends('frontend.layouts.app')

@section('app')
    @if(!empty($result))
        @foreach($result as $value)            
            <div class="col-sm-4">
                <div class="product-image-wrapper">        
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{ asset('upload/product/avatar/' . json_decode($value['avatar'])[0]) }}" alt="{{ $value['name'] }}"  style="width:255px; height:190px;"/>
                            <h2>${{ number_format($value['price']) }}</h2>
                            <p>{{ $value['name'] }}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                        <div class="product-overlay">
                            <div class="overlay-content">
                                <h2>${{ number_format($value['price']) }}</h2>
                                <p>{{ $value['name'] }}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            @if ($value['status'] == 0)
                                <img src="images/home/new.png" class="new" alt="New Product" />
                            @elseif ($value['status'] == 1)
                                <img src="images/home/sale.png" class="sale" alt="Sale Product" />
                            @endif
                        </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                            <li><a href="{{ route('product.detail', $value['id']) }}"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p style="margin-left: 150px; display: inline-block;">Can't find any product with your keyword.</p>
    @endif
    </div>
@endsection
