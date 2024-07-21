<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MemberLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MemberLoginRequest;


class MemberLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(MemberLoginRequest $request)
    {
        // echo 123;
       $login = [
        'email' => $request->email,
        'password' => $request->password,
        'level' => 0
       ];

       $remember = false;

       if($request->remember_me){
        $remember = true;
       }
    //    dd($login, $remember);

       if(Auth::attempt($login, $remember)) {
      return redirect('/');
       }else{
        return redirect('/member/login');
       }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }


    public function index()
    {
        //
        return view ('frontend.login.login');
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
    public function show(MemberLogin $memberLogin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MemberLogin $memberLogin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MemberLogin $memberLogin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MemberLogin $memberLogin)
    {
        //
    }
}
