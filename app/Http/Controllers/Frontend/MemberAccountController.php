<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MemberAccount;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;

class MemberAccountController extends Controller
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
        $xx = Country::all()->toArray();
        // dd($xx);

        return view('frontend.account.account', compact( 'xx'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all()->toArray();
        // dd($category);
        $brand = Brand::all()->toArray();
        // dd($brand);
        return view ('frontend.account.account_add_product', compact('category','brand'));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        //
        $product = new Product();
        $product->id_user = auth()->id(); 
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->id_category = $request->input('id_category');
        $product->id_brand = $request->input('id_brand');
        $product->status = $request->input('status');
        $product->sale = $request->input('status') == '1' ? $request->input('sale') : 0; 
        $product->company = $request->input('company');
        $product->detail = $request->input('detail');

        if ($request->hasFile('avatar')) {
            foreach ($request->file('avatar') as $file) {
                $fileName = $file->getClientOriginalName();
                $file->move('upload/product/avatar', $fileName);
                $avatarFiles[] = $fileName;
            }
            $product->avatar = json_encode($avatarFiles);
        }

        if ($product->save()){
            return redirect()->back()->with('success', __('Update profile success'));
        }else{
            return redirect()->back()->withErrors('Update profile Error');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(MemberAccount $memberAccount)
    {

        $userId = Auth::id();
        $products = Product::where('id_user', $userId)->get();
       
        return view('frontend.account.account_product',compact('products'));


        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all()->toArray();
        // dd($category);
        $brands = Brand::all()->toArray();
        return view('frontend.account.account_edit_product', compact('product', 'categories', 'brands'));
        //
    }

     public function updateProduct(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->id_category = $request->input('id_category');
        $product->id_brand = $request->input('id_brand');
        $product->status = $request->input('status');
        $product->sale = $request->input('status') == '1' ? $request->input('sale') : 0;
        $product->company = $request->input('company');
        $product->detail = $request->input('detail');

        if ($request->hasFile('avatar')) {
            $avatarFiles = [];
            foreach ($request->file('avatar') as $file) {
                $fileName = $file->getClientOriginalName();
                $file->move('upload/product/avatar', $fileName);
                $avatarFiles[] = $fileName;
            }
            $product->avatar = json_encode($avatarFiles);
        }

        if ($product->save()) {
            return redirect()->back()->with('success', __('Update profile success'));
        } else {
            return redirect()->back()->withErrors('Update profile Error');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request)
    {


        // echo 123;
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
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $product = Product::findOrFail($id);
        if ($product->delete()) {
            return redirect()->back()->with('success', __('Product deleted successfully'));
        } else {
            return redirect()->back()->withErrors('Product deletion failed');
        }
    }
}
