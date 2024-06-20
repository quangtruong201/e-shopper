@extends('frontend.layouts.app')
@section('app')
<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Account</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							
							
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{url ('member/account/update')}}">account</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{url ('member/account/product')}}">My product</a></h4>
								</div>
							</div>
							
						</div><!--/category-products-->
					
						
					</div>
				</div>
				<div class="col-sm-9">
					<div class="table-responsive cart_info">
						<table class="table table-condensed">
							<thead>
								<tr class="cart_menu">
									<td class="image">image</td>
									<td class="description">name</td>
									<td class="price">price</td>
									
									<td class="total">action</td>
									
								</tr>
							</thead>
							<tbody>
							@foreach($products as $product)

								
								<tr>
									<td class="cart_product">
									<img src="{{ asset('upload/product/avatar/' . json_decode($product->avatar)[0]) }}" alt="{{ $product->name }}" style="width: 100px; height: 70px;" />
									</td>
									
									<td class="cart_description">
										<h4><a href="">{{ $product->name }}</a></h4>
										
									</td>
									<td class="cart_price">
										<p>{{ $product->price }}</p>
									</td>
									
									<td class="cart_total">
										<a href="{{ route('edit_product', $product->id) }}">Edit</a>
										<a href="{{ route('delete_product', $product->id) }}">Delete</a>
									</td>
									
								</tr>
							@endforeach
                              <form action="{{ route('add_product') }}">
                                @csrf
                              <button type="submit" class="btn btn-default">Add Product</button>
                              </form>

							
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
    @endsection