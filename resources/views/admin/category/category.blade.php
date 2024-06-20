@extends('admin.layouts.content')
@section('content')

<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">List Category</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Basic Table</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            @foreach($data as $category)
                                            <tr>
                                                <th scope="row">{{ $category['id'] }}</th>
                                                <td>{{ $category['title'] }}</td>
                                                <td class="m-icon"><a href="{{ route('edit.category',['id' => $category->id]) }}" class="m-r-10 mdi mdi-auto-fix"></a></td>
                                                <td class="m-icon"><a href="{{ route('delete.category',['id' => $category->id]) }}" class="m-r-10 mdi mdi-archive"></a></td>
                                            </tr>
                                             @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>     
                                {!! $data->links('pagination::bootstrap-4') !!}
                                
                             </div>
                         </div>
                     </div>     
                  </div>
                  <div class="form-group">
                        <div class="col-sm-12">
                            <a href="{{ route('create.category') }}" class="btn btn-success">Add Country</a>
                        </div>
                </div>
@endsection