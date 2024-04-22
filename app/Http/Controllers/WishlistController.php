<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;


class WishlistController extends Controller
{
    public function AddWishlist($id)
    {
        if (Auth::id())
        {
            
            $user= auth()->user();
            $product=Product::find($id);
           
            
            $wishlist= new Wishlist;
            $wishlist->user_id=$user->id;
            $wishlist->user_email=$user->email;
            $wishlist->item_name=$product->name;
            $wishlist->product_id=$product->id;
            $wishlist->price=$product->price;
            $wishlist->save();
           
          

            return redirect()->back();
        }
        
        else
        {
            return redirect("login");
        }
    }
    public function wishlist()
    {
    $id = Auth::user()->id;
    $wishlist = wishlist::where('user_id', '=', $id)->get();

    return view("wishlist", compact('wishlist'));
    }
    
    
    public function remove_wishlist($id)
    {
      $wishlist=wishlist::find($id);
      $wishlist->delete();
      return redirect()->back();

    }
    public function wishlist_order(Request $request, $id)
    {
        // Retrieve wishlist ID from form data
        $wish_id = $request->input('wishlist_id');

        // Retrieve authenticated user
        $user = auth()->user();


        // Find the product by ID
        $product = Product::find($id);

        // Create a new cart item
        $cart = new Cart;
        $cart->user_id = $user->id;
        $cart->user_email = $user->email;
        $cart->address = $user->address;
        $cart->item_name = $product->name;
        $cart->item_quantity = $request->wish_quantity;
        $cart->price = $product->price;
        
        $sold=$request->wish_quantity;
        $stock = $product->quantity;
        $product->quantity=$stock-$sold;
        $product->save();


        
        
        $cart->save();

        // Find the wishlist by ID
        $wishlist = Wishlist::find($wish_id);

        // Check if wishlist exists before deleting
        if ($wishlist) {
            $wishlist->delete();
        }

        return redirect()->back();
    }

}
