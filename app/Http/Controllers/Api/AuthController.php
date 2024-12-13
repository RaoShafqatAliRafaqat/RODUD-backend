<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UsersResource;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try{
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $token = $user->createToken('authToken')->plainTextToken;
            $user = new UsersResource($user);
            
            
            $data = [
                'token' => $token,
                'user' => new UsersResource($user)
            ];
            $response = generateResponse($data, false, 'User registered successfully', null, 'object');
            $code = 201;
            DB::commit();
        }catch (\Exception $e) {
            DB::rollback();
            $errorMsg = 'Error on line '.$e->getLine().' in '.$e->getFile()." ".$e->getMessage();
            $code = $e->getCode();
            $response = generateResponse(null, false, $errorMsg, null, 'object');
        }
        return response()->json($response, $code);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            
            $data = [
                'token' => $token,
                'user' => new UsersResource($user)
            ];
            $response = generateResponse($data, false, 'User logged in successfully', null, 'object');
            return response()->json($response, 200);
        }
        $response = generateResponse(null, false, 'Invalid credentials', null, 'object');
        return response()->json($response, 401);
    }

    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the request
        $request->user()->currentAccessToken()->delete();

        // Return a success response
        return response()->json([
            'message' => 'Logged out successfully.',
        ], 200);
    }
}
