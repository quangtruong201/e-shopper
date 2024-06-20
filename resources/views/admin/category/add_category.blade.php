@extends('admin.layouts.content')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Title</title>
</head>
<body>


    <h1>Add New Category</h1>
    

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
    <form  class="form-horizontal form-material" method="POST">
    @csrf                        
        <div class="form-group">
            <label class="col-md-12">Title</label>
            <div class="col-md-12">
                <input id="title" name="title" type="text" placeholder="Title" class="form-control form-control-line" >
            </div>
        </div>                             
        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-success">Add Category</button>
            </div>
        </div>
    </form>


</body>
</html>
@endsection
