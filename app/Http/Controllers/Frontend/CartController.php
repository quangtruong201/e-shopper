<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{

    public function addToCart(Request $request)
    {
        $id = $request->getId;
        $array = [];
        $array['id'] = $id;
        $array['qty'] = 1;
    
        if (session()->has('cart')) {
            $getSession = session()->get('cart');
            $flag = 1;
            foreach ($getSession as $key => $value) {
                if ($id == $value['id']) {
                    $getSession[$key]['qty'] += 1;
                    session()->put('cart', $getSession);
                    $flag = 0;
                    break;
                }
            }
            if ($flag == 1) {
                session()->push('cart', $array);
            }
        } else {
            session()->push('cart', $array);
        }
    
        $cartQuantity = session()->has('cart') ? collect(session('cart'))->sum('qty') : 0;
    
        return response()->json(['success' => 'Product added to your cart successfully.', 'cartQuantity' => $cartQuantity]);
    }
    
    /**
     * Display a listing of the resource.
     */

     


     
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
    public function show()
    {
        if (session()->has('cart')) {
            $idProduct = session()->get('cart');
            $products = [];
            foreach ($idProduct as $key => $value) {
                $product = Product::find($value['id']);
                if ($product) {
                    $product->qty = $value['qty'];
                    $products[] = $product;
                }
            }

            $sum = 0;
            foreach ($products as $product) {
                $sum += $product->price * $product->qty;
            }

            return view('frontend.cart.cart', compact('products', 'sum'));
        } else {
            return view('frontend.cart.cart');
        }

        
    }



    public function updateCartSession(Request $request)
    {
        $productId = $request->productId;
        $quantity = $request->quantity;
    
        $cart = session()->get('cart');
    
        if ($cart && !empty($cart)) {
            foreach ($cart as &$item) {
                if ($item['id'] == $productId) {
                    if ($quantity > 0) {
                        $item['qty'] = $quantity;
                    } else {
                        $item = null; 
                    }
                    break;
                }
            }
            $cart = array_filter($cart);
            session()->put('cart', $cart);
        }
    
       echo "thanh cong";
    }
    
    
    
    

    


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (session()->has('cart')) {
            $getCart = session()->pull('cart');
            foreach ($getCart as $key => $value) {
                if ($id == $value['id']) {
                    unset($getCart[$key]);
                }
            }
            session()->put('cart', $getCart);
        }
        $getSession = session()->get('cart');
        if (empty($getSession)) {
            session()->forget('cart');
        }
        return back();
    }
}
