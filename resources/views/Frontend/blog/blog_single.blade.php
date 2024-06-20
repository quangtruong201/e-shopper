@extends('frontend.layouts.app')
@section('app')
<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Latest From our Blog</h2>
        <form method="post">
            @csrf
            <div class="single-blog-post">
                <h3>{{ $data->title }}</h3>
                <div class="post-meta">
                    <ul>
                        <li><i class="fa fa-user"></i> Quang hihi</li>
                        <li><i class="fa fa-clock-o"></i> {{ date('h:i a', strtotime($data->created_at)) }}</li>
                        <li><i class="fa fa-calendar"></i> {{ date('M d, Y', strtotime($data->created_at)) }}</li>
                    </ul>
                    <div class="rate">
                        <div class="vote">
                            <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                            <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                            <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                            <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                            <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
                            <span class="rate-np">{{ $averageRating }}</span>
                        </div> 
                    </div>
                </div>
                <a href="">
                    <img src="{{ asset('/public/blog_avatars/'.$data->image) }}" alt="{{ $data->title }}">
                </a>
                <p>{{ $data->description }}</p>
                <div class="pager-area">
                    <ul class="pager pull-right">
                        <li>
                            @if($prevBlog)
                                <a href="{{ route('blog.single', ['id' => $prevBlog->id]) }}" >&lt;&lt; Pre</a>
                            @endif
                        </li>
                        <li>
                            @if($nextBlog)
                                <a href="{{ route('blog.single', ['id' => $nextBlog->id]) }}">Next &gt;&gt;</a>
                            @endif
                        </li>
                    </ul>
                </div>

            </div>

        </form>
    </div><!--/blog-post-area-->

    

<!-- <div class="rating-area">
    <ul class="ratings">
        <li class="rate-this">Rate this item:</li>
        <li>
            <i class="fa fa-star color"></i>
            <i class="fa fa-star color"></i>
            <i class="fa fa-star color"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </li>
        <li class="color">(6 votes)</li>
    </ul>
    <ul class="tag">
        <li>TAG:</li>
        <li><a class="color" href="">Pink <span>/</span></a></li>
        <li><a class="color" href="">T-Shirt <span>/</span></a></li>
        <li><a class="color" href="">Girls</a></li>
    </ul>
</div>/rating-area -->

<div class="socials-share">
    <a href=""><img src="images/blog/socials.png" alt=""></a>
</div><!--/socials-share-->

<!-- <div class="media commnets">
    <a class="pull-left" href="#">
        <img class="media-object" src="images/blog/man-one.jpg" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading">Annie Davis</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <div class="blog-socials">
            <ul>
                <li><a href=""><i class="fa fa-facebook"></i></a></li>
                <li><a href=""><i class="fa fa-twitter"></i></a></li>
                <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                <li><a href=""><i class="fa fa-google-plus"></i></a></li>
            </ul>
            <a class="btn btn-primary" href="">Other Posts</a>
        </div>
    </div>
</div> --><!--Comments-->
<div class="response-area">
    <h2>3 RESPONSES</h2>
    <ul class="media-list">
    @foreach($comments as $comment)
    @if($comment->level == 0)
        <li class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="images/blog/man-two.jpg" alt="">
            </a>
            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>{{ $comment->name_user }}</li>
                    <li><i class="fa fa-clock-o"></i> {{ date('h:i a', strtotime($comment->time)) }}</li>
                    <li><i class="fa fa-calendar"></i> {{ date('M d, Y', strtotime($comment->time)) }}</li>
                </ul>
                <p>{{ $comment->comment }}</p>
                <a class="btn btn-primary reply-btn" id="{{ $comment->id }}" href="#cmt"><i class="fa fa-reply"></i>Replay</a>
                <ul>
                    @foreach($comments as $reply)
                        @if($reply->level == $comment->id)
                            <li class="media second-media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="images/blog/man-three.jpg" alt="">
                                </a>
                                <div class="media-body">
                                    <ul class="sinlge-post-meta">
                                        <li><i class="fa fa-user"></i>{{ $reply->name_user }}</li>
                                        <li><i class="fa fa-clock-o"></i> {{ date('h:i a', strtotime($reply->time)) }}</li>
                                        <li><i class="fa fa-calendar"></i> {{ date('M d, Y', strtotime($reply->time)) }}</li>
                                    </ul>
                                    <p>{{ $reply->comment }}</p>
                                    <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </li>
    @endif
@endforeach

        
        <!-- <li class="media second-media">
            <a class="pull-left" href="#">
                <img class="media-object" src="images/blog/man-three.jpg" alt="">
            </a>
            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>Janis Gallagher</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
            </div>
        </li>
        <li class="media second-media">
            <a class="pull-left" href="#">
                <img class="media-object" src="images/blog/man-three.jpg" alt="">
            </a>
            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>Janis Gallagher</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
            </div>
        </li> -->
        <!-- <li class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="images/blog/man-four.jpg" alt="">
            </a>
            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>Janis Gallagher</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
            </div>
        </li> -->
        <!-- <li class="media second-media">
            <a class="pull-left" href="#">
                <img class="media-object" src="images/blog/man-three.jpg" alt="">
            </a>
            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>Janis Gallagher</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
            </div>
        </li>
        <li class="media second-media">
            <a class="pull-left" href="#">
                <img class="media-object" src="images/blog/man-three.jpg" alt="">
            </a>
            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>Janis Gallagher</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
            </div>
        </li>
        <li class="media second-media">
            <a class="pull-left" href="#">
                <img class="media-object" src="images/blog/man-three.jpg" alt="">
            </a>
            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>Janis Gallagher</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
            </div> -->
        </li>
    </ul>					
</div><!--/Response-area-->
<div class="replay-box">
    <div class="row">
        <div class="col-sm-12">
            <h2>Leave a replay</h2>
            
            <form method="post" id="cmt" >
            @csrf
                <div class="text-area">
                    <div class="blank-arrow">
                        <label>Your Name</label>
                    </div>
                    <span>*</span>
                    <textarea name="message" rows="11"></textarea>
                    <input type="hidden" value="0" name="level" class="level" />
                    <button type="submit" id="post_comment" class="btn btn-primary" href="">post comment</button>
                </div>
            </form>
        </div>
    </div>
</div><!--/Repaly Box-->
</div>	

    <script>
    	
    	$(document).ready(function(){

            $.ajaxSetup({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
			//vote
			$('.ratings_stars').hover(
	            // Handles the mouseover
	            function() {
	                $(this).prevAll().andSelf().addClass('ratings_hover');
	                // $(this).nextAll().removeClass('ratings_vote'); 
	            },
	            function() {
	                $(this).prevAll().andSelf().removeClass('ratings_hover');
	                // set_votes($(this).parent());
	            }
	        );

			$('.ratings_stars').click(function(){
				var checkLogin = "{{Auth::Check()}}";
                alert(checkLogin)


                if(checkLogin){
                    var rate =  $(this).find("input").val();
                    var id_blog = "{{$data->id}}";
                    var time = new Date().toISOString();
                    // alert(rate);
                    if ($(this).hasClass('ratings_over')) {
                        $('.ratings_stars').removeClass('ratings_over');
                        $(this).prevAll().andSelf().addClass('ratings_over');
                    } else {
                        $(this).prevAll().andSelf().addClass('ratings_over');
                    }


                    $.ajax({
                        type: 'POST',
                        url: '{{ route("save-rating") }}', 
                        data: {
                            rate: rate,
                            id_blog: id_blog,
                            time: time
                        },
                        success: function(response){
                            console.log('Rating saved successfully.');
                        },
                        error: function(xhr, status, error){
                            console.error(xhr.responseText);
                        }
                    });


                }else{
                    alert("vui long login de rate");
                
                }
		    });
		});




        $(document).ready(function(){

            $.ajaxSetup({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.reply-btn').click(function(){
                var commentId = $(this).attr('id');
                console.log(commentId);
               
                var level = $('input[name="level"]').val(commentId);
                console.log(level);
                
        
                    
            });

            $('#post_comment').click(function(){
                var checkLogin = "{{Auth::Check()}}";
                // alert(checkLogin)
                // console.log("hhhhhh");

                if(checkLogin){
                    var id_blog = "{{$data->id}}";
                    var comment = $('textarea[name="message"]').val();
                    var level = $('input[name="level"]').val();
                    // console.log(level);

                    $.ajax({
                        type: 'POST',
                        url: '{{ route("post-comment") }}', 
                        data: {
                            comment: comment,
                            id_blog: id_blog,
                            level:level
                        },
                        success: function(response){
                            console.log(' Post Comment successfully.');
                        },
                        error: function(xhr, status, error){
                            console.error(xhr.responseText);
                        }
                    });

                }else{
                    alert("vui long login de cmt");
                
                }

                return false;
            });
        });

    </script>
@endsection