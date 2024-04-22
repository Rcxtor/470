<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\Invoice;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
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

    public function cash_order( Request $request)
    {
        $user=Auth::user();
        $userid=$user->id;
        
        $data=cart::where('user_id','=',$userid)->get();
        
        $pdata=User::where('id','=',$userid)->first();
        foreach($data as $data)
        {
           $order=new order;
           $invoice=new invoice;
           $order->user_id=$pdata->id;
           $order->user_email=$pdata->email;
           $order->user_address=$pdata->address;
           $order->user_phone=$pdata->phone;

           

   
           $order->product_name=$data->item_name;
           
           $order->quantity=$data->item_quantity;
           $order->price=$data->price;
           $order->payment="cash";



           
           ####endregion
           $invoice->user_id=$pdata->id;
           $invoice->user_email=$pdata->email;
           $invoice->user_name=$pdata->name;
           $invoice->product_name=$data->item_name;          
           $invoice->quantity=$data->item_quantity;
           $invoice->price=$data->price;
           $invoice->payment="cash";



















           $order->save();
           $invoice->save();


           $product = Product::where('name', $data->item_name)->first();
           if ($product) {
                $product->quantity -= $data->item_quantity;
                if ($product->quantity < 0) {
                    $product->quantity = 0; // Ensure quantity doesn't go negative
                }
                $product->save();
           }



           
           
           


           
           
           
           
           $cart_id=$data->id;
           $cart=cart::find($cart_id);
           $cart->delete();
           $request->session()->flush();

        }

        $this->sendemail($invoice);
        return redirect("login");
        

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
        $user=Auth::user();
        $userid=$user->id;
        
        $data=cart::where('user_id','=',$userid)->get();
        
        $pdata=User::where('id','=',$userid)->first();
        foreach($data as $data)
        {
           $order=new order;
           $order->user_id=$pdata->id;
           $order->user_email=$pdata->email;
           $order->user_address=$pdata->address;
           $order->user_phone=$pdata->phone;

           

   
           $order->product_name=$data->item_name;
           
           $order->quantity=$data->item_quantity;
           $order->price=$data->price;
           $order->payment="card";
           $order->save();

           $product = Product::where('name', $data->item_name)->first();
           if ($product) {
                $product->quantity -= $data->item_quantity;
                if ($product->quantity < 0) {
                    $product->quantity = 0; // Ensure quantity doesn't go negative
                }
                $product->save();
           }
           
           $cart_id=$data->id;
           $cart=cart::find($cart_id);
           $cart->delete();
           $request->session()->flush();
        
        
        

        
      
        }        
        Session::flash('success', 'Payment successful!');      
        return back();
    }

    public function sendemail($invoice)
    {
    
    
    
   
    Mail::to($invoice->user_email)->send(new OrderMail($invoice));
    $invoice->delete();
    
    
    }   


}
