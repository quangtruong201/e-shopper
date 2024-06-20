<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MemberBlog;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Rate;
use App\Models\Comment;

class MemberBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Blog::paginate(3);
        // dd($data);
        return view('frontend.blog.blog', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
    }

    public function saveRating(Request $request)
    {
        $rate = new Rate();
        $rate->rate = $request->rate;
        $rate->id_blog = $request->id_blog; 
        $rate->id_user = auth()->id(); 
        $rate->save();
        
        echo "thanh cong";
    }

    public function postComment(Request $request){
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->id_blog = $request->id_blog; 
        $comment->id_user = auth()->id(); 
        $comment->avatar_user = auth()->user()->avatar;
        $comment->name_user = auth()->user()->name;
        $comment->time = date('Y-m-d H:i:s');
        
        $comment->level = $request->level;

        $comment->save();
        
       echo "thanh cong";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Blog::findOrFail($id);
        $prevBlog = Blog::where('id', '<', $data->id)->orderBy('id')->first();
        $nextBlog = Blog::where('id', '>', $data->id)->orderBy('id')->first();

        // $sumOfRatings = Rate::where('id_blog', $id)->sum('rate');
        $averageRating = round(Rate::where('id_blog', $id)->avg('rate'), 1);
        // dd($sumOfRatings);
        // dd($averageRating);
        $comments = Comment::where('id_blog', $id)->orderBy('time', 'desc')->get();
        // dd(comment);
    
        
        // dd($data);
        return view('frontend.blog.blog_single',compact('data','prevBlog', 'nextBlog','averageRating', 'comments'));


    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MemberBlog $memberBlog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MemberBlog $memberBlog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MemberBlog $memberBlog)
    {
        //
    }
}
