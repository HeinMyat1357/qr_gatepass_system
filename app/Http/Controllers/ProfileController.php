<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
'user_name' => ['required','string','max:255','regex:/^[a-zA-Z0-9\s]+$/','unique:users,user_name,' . $user->id],
            'phone_number' => 'nullable|string|max:20',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|confirmed|min:6',
        ]);

        // ✅ Update basic info
        $user->name = $request->name;
         $user->user_name = $request->user_name;
        $user->phone_number = $request->phone_number;
       

        // ✅ Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/profile_images'), $imageName);
            $user->profile_image = $imageName;
        }

        // // ✅ Handle password change (if fields are filled)
        // if ($request->filled('current_password') && $request->filled('new_password')) {
        //     if (Hash::check($request->current_password, $user->password)) {
        //         $user->password = Hash::make($request->new_password);
        //     } else {
        //         return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        //     }
        // }

        $user->save();

        return back()->with('success', 'Profile updated successful.');
    }

    public function changePassword(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|confirmed|min:6',
    ]);

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('password_error', 'Current password is incorrect.');
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('password_success', 'Password changed successfully.');
}


}
