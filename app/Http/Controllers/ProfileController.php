<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $userID = $user->id;
        // dd($userID);
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'phone' => 'numeric',
            'division' => 'string|max:255',
            'city' => 'string|max:255',
            'address' => 'string|max:255',
            'photo' => 'string|max:255',
        ]);
        // dd($validatedData);
        
        $data = User::find($userID);
        $data->update($validatedData);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    
    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $userID = $user->id;
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        $newPassword = Hash::make($request->new_password);
        $user = User::find($userID);
        $user->password = $newPassword;
        $user->save();


        return redirect()->route('profile.show')->with('success', 'Password changed successfully!');
    }

    public function updateEmail(Request $request)
    {
        $user = Auth::user();
        $userID = $user->id;
        $request->validate([
            'current_password' => 'required|string',
            'new_email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }
        // $newPassword = Hash::make($request->new_password);
        $user = User::find($userID);
        $user->email = $request->new_email;
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Email changed successfully!');
    }
    public function orders()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('profile.orders', compact('orders'));
    }
}
