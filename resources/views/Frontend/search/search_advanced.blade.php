@extends('frontend.layouts.app')

@section('app')
<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Features Items</h2>
        <form method="POST" action="{{ route('search.product.advanced') }}" style="display:flex; gap: 10px; margin-bottom:50px;">
            @csrf
            <input type="text" name="name" placeholder="Name" value="{{ request('name') }}">

            <select name="price_range">
                <option value="">Select Price Range</option>
                <option value="0-1000" {{ request('price_range') == '0-1000' ? 'selected' : '' }}>0-1000</option>
                <option value="1000-2000" {{ request('price_range') == '1000-2000' ? 'selected' : '' }}>1000-2000</option>
            </select>

            <select name="category">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>

            <select name="brand">
                <option value="">All Brands</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                        {{ $brand->title }}
                    </option>
                @endforeach
            </select>

            <select name="status">
                <option value="">All Status</option>
                <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                <option value="sale" {{ request('status') == 'sale' ? 'selected' : '' }}>Sale</option>
            </select>

            <button type="submit">Search</button>
        </form>
        <div class="row">
            @if($result->isNotEmpty())
                @foreach($result as $value)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    @php
                                        $avatar = json_decode($value->avatar, true);
                                        $avatarUrl = $avatar ? asset('upload/product/avatar/' . $avatar[0]) : asset('upload/product/default.png');
                                    @endphp
                                    <img src="{{ $avatarUrl }}" alt="{{ $value->name }}" style="width:255px; height:190px;"/>
                                    <h2>${{ number_format($value->price) }}</h2>
                                    <p>{{ $value->name }}</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2>${{ number_format($value->price) }}</h2>
                                        <p>{{ $value->name }}</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                    @if ($value->status == 0)
                                        <img src="images/home/new.png" class="new" alt="New Product" />
                                    @elseif ($value->status == 1)
                                        <img src="images/home/sale.png" class="sale" alt="Sale Product" />
                                    @endif
                                </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    <li><a href="{{ route('product.detail', $value->id) }}"><i class="fa fa-plus-square"></i>View details</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-sm-12">
                    {{ $result->links() }}
                </div>
            @else
                <p style="margin-left: 150px; display: inline-block;">Can't find any product with your keyword.</p>
            @endif
        </div>
    </div><!--features_items-->
</div>
@endsection
