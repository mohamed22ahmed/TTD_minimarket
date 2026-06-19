<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|string|email|max:255|unique:users',
            'phone'          => 'required|string|max:255|unique:users',
            'user_type'      => 'required|in:owner,customer',
            'market_name'    => 'required_if:user_type,owner|string|max:255',
            'market_name_ar' => 'required_if:user_type,owner|string|max:255',
            'cr_number'      => 'required_if:user_type,owner|string|max:255',
        ]);

        $user = User::create([
            'id'             => Str::uuid(),
            'name'           => $request->name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'user_type'      => $request->user_type
        ]);

        $market = $user->market()->create([
            'id'             => Str::uuid(),
            'name'    => $request->market_name,
            'name_ar' => $request->market_name_ar,
            'cr_number'      => $request->cr_number,
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }
}
