@extends('frontend.layouts.app')
@section('app')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Account</h2>
                    <div class="panel-group category-products" id="accordian">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="{{url('member/account/update')}}">Account</a></h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="{{url('member/account/product')}}">My Products</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="blog-post-area">
                    <h2 class="title text-center">Update Product</h2>
                    <div class="signup-form">
                        <h2>Edit Product</h2>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Success!</h4>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Errors!</h4>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif 

                        <form method="POST" action="{{ route('update_product', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="name" placeholder="Name" value="{{ $product->name }}" />
                            <input type="text" name="price" placeholder="Price" value="{{ $product->price }}"/>
                            
                            <select name="id_category" class="form-control form-control-line">
                                @foreach($categories as $category)
                                    <option value="{{ $category['id'] }}" {{ $category['id'] == $product->id_category ? 'selected' : '' }}>{{ $category['title'] }}</option>
                                @endforeach 
                            </select>

                            <select name="id_brand" class="form-control form-control-line">
                                @foreach($brands as $brand)
                                    <option value="{{ $brand['id'] }}" {{ $brand['id'] == $product->id_brand ? 'selected' : '' }}>{{ $brand['title'] }}</option>
                                @endforeach 
                            </select>

                            <select name="status" class="form-control form-control-line" id="status-select">
                                <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>New</option>
                                <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Sale</option>
                            </select>
                            
                            <input type="text" name="sale" placeholder="%" id="sale-input" value="{{ $product->status == 1 ? $product->sale : '' }}" style="{{ $product->status == 1 ? '' : 'display: none;' }}" />
                            
                            <input type="text" name="company" placeholder="Company" value="{{ $product->company }}"/>
                            <input type="text" name="detail" placeholder="Detail" value="{{ $product->detail }}"/>
                            <input type="file" name="avatar[]" multiple />

                            <button type="submit" class="btn btn-default">Update Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.getElementById('status-select');
        const saleInput = document.getElementById('sale-input');

        statusSelect.addEventListener('change', function() {
            if (statusSelect.value == '1') {
                saleInput.style.display = 'block';
            } else {
                saleInput.style.display = 'none';
            }
        });
    });
</script>
@endsection
