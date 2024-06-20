@extends('frontend.layouts.app')
@section('app')
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
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form method="post" enctype="multipart/form-data">
						@csrf
							<input name="name" type="text" placeholder="Name" />
							<input name="email" type="email" placeholder="Email Address" />
							<input name="password" type="password" placeholder="Password" />
							<input name="phone" type="phone" placeholder="Phone No" />
							<input name="address" type="address" placeholder="Address" />
							<input name="avatar" type="file" placeholder="Avatar" />					
							<div class="form-group">
								<label  class="col-sm-12">Select Country</label>
								<div class="col-sm-12">
									<select name="id_country" class="form-control form-control-line" >
									@foreach($xx as $country)
									<option value="{{ $country['id'] }}">{{ $country['title'] }}</option>
									@endforeach 
									</select>
								</div>
							</div>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	
@endsection