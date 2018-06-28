<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Taken from https://www.5balloons.info/setting-up-change-password-with-laravel-authentication/
 *
 * @package App\Http\Controllers\Auth
 */
class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()->back()
                ->with("error", "Your current password does not match the password you provided. Please try again.");
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) === 0) {
            return redirect()->back()
                ->with("error", "New password cannot be the same as your current password. Please try again.");
        }

        $this->validate($request, [
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success", "Password changed successfully !");
    }
}
