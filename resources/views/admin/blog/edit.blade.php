<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
</head>
<body>

@extends('admin.layouts.content')
@section('content')
    <h1>Edit Blog</h1>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('edit.blog', $data->id) }}" class="form-horizontal form-material" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
        <label class="col-md-12">Title</label>
        <div class="col-md-12">
            <input id="title" name="title" type="text" placeholder="Title" class="form-control form-control-line" value="{{ $data->title }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-12">Image</label>
        <div class="col-md-12">
            <input name="avatar" type="file" class="form-control form-control-line" value="{{ $data->image }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-12">Description</label>
        <div class="col-md-12">
            <textarea name="description" class="form-control" id="Description" >{{ $data->description }}</textarea>
        </div>
    </div>

    <div class="form-group col-md-12">
        <label for="">Content</label>
        <textarea name="content" class="form-control" id="editor1" ">{{ $data->content }}</textarea>
    </div>
       
        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-success">Update Blog</button>
            </div>
        </div>
    </form>
@endsection

</body>
</html>
