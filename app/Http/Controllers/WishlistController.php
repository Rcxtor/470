<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function AddWishlist(Request $request ,$id)
    {
        if (Auth::id())
        {
            
            $user= auth()->user();
            $product=Product::find($id);
           
            
            $wishlist= new Cart;
            $wishlist->user_id=$user->id;
            $wishlist->user_email=$user->email;
            $wishlist->product_id=$product->id;
            $wishlist->save();
          

            return redirect()->back();
        }
        
        else
        {
            return redirect("login");
        }
    }
}
