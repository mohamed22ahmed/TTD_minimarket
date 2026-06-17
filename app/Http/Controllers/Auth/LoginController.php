<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|email',
        ]);

        $user = User::where('email', $request->username)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $otp = mt_rand(10000, 99999);
        $user->otp = $otp;
        $user->save();

        return response()->json(['message' => 'OTP sent successfully', 'otp' => $otp]);
    }
}
