<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\product;
use App\Models\order;
use Cartalyst\Stripe\Api\Orders;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Mail\sendmail;
use App\Models\User;


class cartcontroller extends Controller
{
    public function addtocart(product $product){
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }else{
            $cart = new Cart();
        }
        $cart->add($product);
        session()->put('cart',$cart);
        notify()->success('Product is added to cart');
        return redirect()->back();
    }

    public function showcart(){
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }
        else{
            $cart = null;
    }
    
    return view('cart',compact('cart'));
   }
   public function updatecart(Request $request,product $product){
       $request->validate([
           'qty' =>'required|numeric|min:1',
       ]);
    $cart = new cart(session()->get('cart'));
    $cart->updateqty($product->id,$request->qty);
    session()->put('cart',$cart);
    notify()->success('Product is update to cart');
    return redirect()->back();
    }
    public function removecart(product $product){
        $cart = new cart(session()->get('cart'));
        $cart->remove($product->id);
        if($cart->totalQty<=0){
            session()->forget('cart');
        }else{
            session()->put('cart',$cart);

    }
    notify()->success('Product is deleted from cart');
    return redirect()->back();
 }
 public function checkout($amount){
    if(session()->has('cart')){
        $cart = new Cart(session()->get('cart'));
        return view('checkout',compact('amount','cart'));
    }
    else{
        $cart = null;
    }
    return view('checkout',compact('amount','cart'));
 }
 public function charge(Request $request){
    $charge = Stripe::charges()->create([
        'currency'=>"INR",
        'source'=>$request->stripeToken,
        'amount'=>$request->amount,
        'description'=>'Test'
    ]);

    $chargeId = $charge['id'];
    if(session()->has('cart')){
        $cart = new Cart(session()->get('cart'));
        
    }
    else{
        $cart = null;
    }

    \Mail::to(auth()->user()->email)->send(new Sendmail($cart));


    if(session()->has('cart')){
        $cart = new Cart(session()->get('cart'));
    }else{
        $cart = null;
    } 
    if($chargeId){
        auth()->user()->orders()->create([

            'cart'=>serialize(session()->get('cart'))
        ]);

        session()->forget('cart');
        notify()->success(' Transaction completed!');
        return redirect()->to('/');

    }else{
        return redirect()->back();
    }

    }
    //for logdin user
    public function order(){
        $orders = auth()->user()->orders;
        $carts = $orders->transform(function($cart,$key){
            return unserialize($cart->cart);
        });
        return view('order',compact('carts'));
    }  
    
    //for admin
    public function userorder(){
        $order = order::latest()->get();
        return view('admin.order.index',compact('order'));
    }
    public function viewUserOrder($userid,$orderid){
        $user = User::find($userid);
        $orders = $user->orders->where('id',$orderid);
        $carts =$orders->transform(function($cart,$key){
            return unserialize($cart->cart);

        });
        return view('admin.order.show',compact('carts'));
    }
}
