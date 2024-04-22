<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function coupon(Request $request)
{
    
    $couponCode = $request->coupon_code;
    $total = $request->input('total_price');
    
    $discount = 0;

    
    $coupon = Coupon::where('code', $couponCode)->first();
    

    if ($coupon) {
      
        if ($coupon->type == "1") {
            $discount = $coupon->value; 
        } elseif ($coupon->type == "2") {
            $discount = $coupon->percent_off ;
            $discount=($discount/100)*$total;
        }
    }

   
    session()->put('discount', $discount);
    session()->put('couponCode',$couponCode);


    
    return redirect()->back();
}
    
}
