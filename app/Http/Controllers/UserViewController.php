<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;


class UserViewController extends Controller
{
    public function index ($id)
    {
        if (auth()->user()->role === 'admin'){
            $user = User::find($id);
            $orders = Order::where('user_id', $id)->get();
            return view('user_view', compact('user','orders'));
        }
        else {
            return redirect()->route('welcome');
        }
    }
    public function delete($id): RedirectResponse
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('dashboard')->with('success', 'User removed successfully');
    }

    
    public function update(Request $request, $id)
    {
        $validatedUserData = $request->validate([
            'role' => 'required|string|max:255',
        ]);

        $user = User::find($id);
        $user->update($validatedUserData);
    return redirect()->route('user_view', ['id' => $id])->with('change', 'User updated successfully');
}
}