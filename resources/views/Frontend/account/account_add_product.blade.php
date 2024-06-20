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
					<div class="blog-post-area">
						<h2 class="title text-center">Update user</h2>
						 <div class="signup-form"><!--sign up form-->
						<h2>Add new Product</h2>

						@if(session('success'))
							<div class="alert alert-success alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<h4><i class="icon fa fa-check"></i> Thông báo!</h4>
									{{session('success')}}
							</div>
						@endif

						@if($errors->any())
							<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4><i class="icon fa fa-check"></i> Thông báo!</h4>
								<ul>
									@foreach($errors->all() as $error)
										<li>{{$error}}</li>
									@endforeach
								</ul>
							</div>
						@endif 
						<form method="post" enctype="multipart/form-data">
							<input type="text" name="name" placeholder="Name"/>
							<input type="text" name="price" placeholder="Price"/>
							
							<select name="id_category" class="form-control form-control-line" >
							@foreach($category as $categorys)
							<option value="{{ $categorys['id'] }}">{{ $categorys['title'] }}</option>
							@endforeach 
							</select>

							<select name="id_brand" class="form-control form-control-line" >
							@foreach($brand as $brands)
							<option value="{{ $brands['id'] }}">{{ $brands['title'] }}</option>
							@endforeach 
							</select>

							<select name="status" class="form-control form-control-line" id="status-select">
                                <option value="0">New</option>
                                <option value="1">Sale</option>
                            </select>
                            
                            <input type="text" name="sale" placeholder="%" id="sale-input"/> 
                            
                            <input type="text" name="company" placeholder="Company"/>
                            <input type="text" name="detail" placeholder="Detail"/>
							<input type="file" name="avatar[]" multiple  />

							<button type="submit" class="btn btn-default">Add Product</button>
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