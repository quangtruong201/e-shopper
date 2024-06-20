<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MemberRegister;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MemberRegisterRequest;

class MemberRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $xx = Country::all()->toArray();
        // dd($xx);
        
        return view('frontend.register.register', compact( 'xx'));
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
    public function store(MemberRegisterRequest $request)
    {
         // get id user
    $userId = Auth::id();

    // get all info of user have id
    $user = User::findOrFail($userId);

    $data = $request->all();

       // get info of file upload
    $file = $request->avatar;

      // check file upload bring to array
    if (!empty($file)){
        $data['avatar'] = $file->getClientOriginalName();  
    }

      //check pass
    if($data['password']){
       // bring to array
        $data['password'] = bcrypt($data['password']);
    }else{
        $data['password'] = $user->password;
    }

    $data['level']=0;
    // update all info in array to table user have id
    // dd($data);
    if ($user->create($data)){
        if(!empty($file)){
            $file->move('upload/user/avatar', $file->getClientOriginalName());
        }
        return redirect()->back()->with('success', __('Update profile success'));
    }else{
        return redirect()->back()->withErrors('Update profile Error');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(MemberRegister $memberRegister)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MemberRegister $memberRegister)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MemberRegister $memberRegister)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MemberRegister $memberRegister)
    {
        //
    }
}
