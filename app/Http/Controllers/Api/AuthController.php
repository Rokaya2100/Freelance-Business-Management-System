<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Traits\jsonTrait;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller

{
    use jsonTrait;
    /**
     * Summary of register
     * @param \App\Http\Requests\RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
    //for upload image
        $image=uploadImage('image','profile_images');
        if($request->role=='admin'){
            return $this->jsonResponse(403, 'You cannot register as admin just freelancer or client', null);
        }
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'country'  => $request->country,
            'role'     => $request->role,
            'image'    => $image,
            'password' => Hash::make($request->password),//bcrypt
        ]);

        // Automatically create a portfolio if the user is a freelancer
        if ($user->role == 'freelancer') {
            Portfolio::create([
                'user_id' => $user->id,
                'description'=>'no description yet',
                'skills'=>'no skills yet'
            ]);
        }
        $token = $user->createToken('YourAppName')->plainTextToken;
        return $this->jsonResponse(201, 'success', ['token' => $token, 'user' => $user]);
    }

    /**
     * Login user and create a token.
     */
    /**
     * Summary of login
     * @param \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            // Create and return token
            $token = $user->createToken('YourAppName')->plainTextToken;
            return $this->jsonResponse(200, 'success', ['token' => $token]);
        }
        return $this->jsonResponse(401, 'Unauthorized');
    }

    /**
     * Logout user and revoke the token.
     */
     /**
      * Summary of logout
      * @param \Illuminate\Http\Request $request
      * @return \Illuminate\Http\JsonResponse
      */
     public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->jsonResponse(200,'Logged out successfully');
    }

}

