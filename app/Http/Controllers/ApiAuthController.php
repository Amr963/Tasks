<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\ApiResponseTrait;

class ApiAuthController extends Controller
{
    use ApiResponseTrait;

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $user->tokens()->delete();
            $user = $user->createToken('Token Name');
            $token = $user->plainTextToken;
            return $this->apiResponse($token, 'massage');
        }
        return $this->apiResponse(null, 'error', 401);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('token name')->plainTextToken;
        $data = [
            'user' => $user,
            'token' => $token,
        ];
        return $this->apiResponse($data, 'user created');
    }

    public function logout()
    {
        $user = Auth::user();
        $user->$this->currentAccessToken()->delete();
        return $this->Apiresponse(null, 'token deleted');
    }

}
