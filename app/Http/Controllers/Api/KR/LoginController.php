<?php

namespace App\Http\Controllers\Api\KR;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors()], 422);
        }
        //get email dan password
        $credentials = $request->only('email', 'password');

        //cek jika email dan password tidak sesuai
        if (!$token = auth()->guard('api_kr')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah',
            ], 401);
        }

        //jika login sukses
        return response()->json([
            'success' => true,
            'user' => auth()->guard('api_kr')->user(),
            'token' => $token
        ], 200);
    }

    public function getUser()
    {
        return response()->json([
            'success' => true,
            'user' => auth()->guard('api_kr')->user(),
        ], 200);
    }

    public function refreshToken(Request $request)
    {
        $refreshToken = JWTAuth::refresh(JWTAuth::getToken());

        //set user dengan token baru
        $user = JWTAuth::setToken($refreshToken)->toUser();

        //set header dengan token baru
        $request->headers->set('Authorization','Bearer '.$refreshToken);

        //response user dengan token baru
        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $refreshToken,
        ], 200);
    }

}
