<?php

namespace App\Http\Controllers\Admin;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Blog::paginate(5);
        return view('admin.blog.blog',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.blog.add_blog');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $data = $request->all();
    
       
        $file = $request->avatar;
    
        if (!empty($file)) {
            
            $data['image'] = $file->getClientOriginalName();  
            $file->move('public/blog_avatars', $file->getClientOriginalName());
        } 

       
        $blog = Blog::create($data);
        
        if ($blog) {
            // echo 11;
            // exit;
            return redirect("/admin/blog/list")->with('success', 'Blog post created successfully!');
        } else {
            // echo 22;
            // exit;
            return redirect()->back()->withErrors('Failed to create blog post.');
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Blog::find($id);
        // dd($data);
        return view('admin.blog.edit', compact('data'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, string $id)
    {

        $id = Blog::findOrFail($id);

        $data = $request->all();
       
        $file = $request->avatar;
    
        if (!empty($file)) {
            
            $data['image'] = $file->getClientOriginalName();  
            
        } 
        // dd($data);
      $blog = $id->update($data);
       
      if ($blog) {
        // echo 11;
        // exit;
        $file->move('public/blog_avatars', $file->getClientOriginalName());
        return redirect("/admin/blog/list")->with('success', 'Blog post created successfully!');
    } else {
        // echo 22;
        // exit;
        return redirect()->back()->withErrors('Failed to create blog post.');
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog, string $id)
    {
        $data = Blog::find($id);
        $data->delete();
        return redirect("/admin/blog/list");
    }
}
