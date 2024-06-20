@extends('frontend.layouts.app')
@section('app')
<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Latest From our Blog</h2>
        <form method="post">
        @csrf
        @foreach($data as $blog)
        <div class="single-blog-post">
            <h3>{{ $blog['title'] }}</h3>
            <div class="post-meta">
                <ul>
                    <li><i class="fa fa-user"></i> Quang hihi</li>
                    <li><i class="fa fa-clock-o"></i> {{ date('h:i a', strtotime($blog['created_at'])) }}</li>
                    <li><i class="fa fa-calendar"></i> {{ date('M d, Y', strtotime($blog['created_at'])) }}</li>

                </ul>
                <span>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                </span>
            </div>
            <a href="">
            <img src="{{ asset('/public/blog_avatars/'.$blog->image) }}" alt="{{ $blog->title }}">
            </a>
            <p>{{ $blog['description'] }}</p>
            <a type="submit" class="btn btn-primary" href="{{ route('blog.single',['id' => $blog->id]) }}">Read More</a>
        </div>
        @endforeach 
        </form>
        <div class="pagination-area">
            <!-- <ul class="pagination">
                <li><a href="" class="active">1</a></li>
                <li><a href="">2</a></li>
                <li><a href="">3</a></li>
                <li><a href=""><i class="fa fa-angle-double-right"></i></a></li>
            </ul> -->
            {!! $data->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
@endsection