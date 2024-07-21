<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\MailNotify;
use App\Http\Requests\checkoutRequest;
use App\Models\Product;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function sendMail(checkoutRequest $request)
{
    $getRequest = $request->all();
    $idProduct = session()->get('cart');

    // Ensure $idProduct is an array
    $idProduct = is_array($idProduct) ? $idProduct : [];

    $product = [];
    // Populate $product if $idProduct is not empty
    if (!empty($idProduct)) {
        foreach ($idProduct as $key => $value) {
            $foundProduct = Product::find($value['id']);
            if ($foundProduct) {
                $productItem = $foundProduct->toArray();
                $productItem['qty'] = $value['qty'];
                $product[] = $productItem;
            }
        }
    }

    $sum = 0;
    // Calculate the sum only if $product is not empty
    if (!empty($product)) {
        foreach ($product as $key => $value) {
            $sum += $value['price'] * $value['qty'];
        }
    }

    $emailTo = "hoquybinh2001@gmail.com"; // Specify the email address here
    $subject = "Mail order product";

    $data = [
        'subject' => $subject,
        'product' => $product,
        'sum' => $sum,
        'getRequest' => $getRequest
    ];

    try {

        
        Mail::to($emailTo)->send(new MailNotify($data));
        session()->forget('cart');

        return view('frontend.cart.cart', ['data' => $data, 'sum' => $sum]); // Pass $sum to the view
    } catch (Exception $th) {
        return response()->json(['Sorry, unable to send mail.'], 500);
    }
}



    

    
}
