<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserLoggedIn;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->username)->orWhere('phone', $request->username)->first();
        event(new UserLoggedIn($user));
        return response()->json(['message' => 'OTP sent successfully, please check your email']);
    }
}
