<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FeedBack;
use Illuminate\Http\Request;
use App\Mail\FeedbackMail;
use Illuminate\Support\Facades\Mail;

class FeedBackController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function showForm()
     {
         return view('frontend.feedback.feedback');
     }
 
     public function sendFeedback(Request $request)
     {
         $request->validate([
             'name' => 'required',
             'email' => 'required|email',
             'message' => 'required'
         ]);
 
         $feedback = Feedback::create($request->all());
 
         $details = [
             'title' => 'Feedback from:  ' . $request->name,
             'body' => $request->message,
             'email' => $request->email
         ];
 
         Mail::to('truongvanquanglb2016@gmail.com')->send(new FeedbackMail($details));
 
         return back()->with('success', 'Feedback sent successfully!');
     }
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FeedBack $feedBack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeedBack $feedBack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FeedBack $feedBack)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeedBack $feedBack)
    {
        //
    }
}
