<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use Session;
use Stripe;


class CartController extends Controller
{
    public function AddCart(Request $request ,$id)
    {
        if (Auth::id())
        {
            
            $user= auth()->user();
            $product=Product::find($id);
           
            
            $cart= new Cart;
            $cart->user_id=$user->id;
            $cart->user_email=$user->email;
            $cart->address=$user->address;
            $cart->item_name=$product->name;
            $cart->item_quantity=$request->quantity;
            $cart->price=$product->price;
            
            
            
            $product->save();

            
            
            $cart->save();
          

            return redirect()->back();
        }
        
        else
        {
            return redirect("login");
        }
    }

    public function cart()
    {
    $id = Auth::user()->id;
    $cart = Cart::where('user_id', '=', $id)->get();

    return view("cart", compact('cart'));
        if (auth()->check())
        {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id)->get();
        return view("cart", compact('cart'));
        }
        else {
        return redirect("login");
    }
        if (auth()->check())
        {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id)->get();
        return view("cart", compact('cart'));
        }
        else {
        return redirect("login");
    }
    }

    public function remove_cart($id)
    {
      $cart=cart::find($id);
      $cart->delete();
      return redirect()->back();

    }
    public function stripe($totalprice)
    {
        
        return view('stripe',compact('totalprice'));
    }
    
    
    public function stripePost(Request $request,$totalprice)
    {
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment." 
        ]);
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }



}
