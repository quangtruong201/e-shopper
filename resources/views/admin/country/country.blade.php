@extends('admin.layouts.content')
@section('content')

<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">List Country</h4>
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
                                            @foreach($data as $country)
                                            <tr>
                                                <th scope="row">{{ $country['id'] }}</th>
                                                <td>{{ $country['title'] }}</td>
                                                <td class="m-icon"><a href="{{ route('edit.country',['id' => $country->id]) }}" class="m-r-10 mdi mdi-auto-fix"></a></td>
                                                <td class="m-icon"><a href="{{ route('delete.country',['id' => $country->id]) }}" class="m-r-10 mdi mdi-archive"></a></td>
                                            </tr>
                                             @endforeach
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
                            <a href="{{ route('create.country') }}" class="btn btn-success">Add Country</a>
                        </div>
                </div>
@endsection