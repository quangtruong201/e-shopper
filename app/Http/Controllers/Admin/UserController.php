<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Country;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
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
        $xx = Country::all()->toArray();
        // dd($xx);
     
        return view('admin.user.user', compact( 'xx'));




        
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request)
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

    // update all info in array to table user have id
    if ($user->update($data)){
        if(!empty($file)){
            $file->move('upload/user/avatar', $file->getClientOriginalName());
        }
        return redirect()->back()->with('success', __('Update profile success'));
    }else{
        return redirect()->back()->withErrors('Update profile Error');
    }
     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
