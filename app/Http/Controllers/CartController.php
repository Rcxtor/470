<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;


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
    }

    public function remove_cart($id)
    {
      $cart=cart::find($id);
      $cart->delete();
      return redirect()->back();

    }



}
