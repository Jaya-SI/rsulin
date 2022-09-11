<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'name' => 'required',
            'nip' => 'required|unique:users',
            'tgl_lahir' => 'required',
            'jk' => 'required',
            'nohp' => 'required',
            'alamat' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:6000',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

            $foto_user = $request->file('image');
            $extensions = $foto_user->getClientOriginalExtension();
            $photoUser = Str::random(10).".".$extensions;
            $uploadPath = env('UPLOAD_PATH')."/users";

        //user create
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nip' => $request->nip,
            'tgl_lahir' => $request->tgl_lahir,
            'jk' => $request->jk,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'image' => $request->file('image')->move($uploadPath, $photoUser),
        ]);

        $credentials = $request->only('email', 'password');
        $token = auth()->guard('api_karyawan')->attempt($credentials);

        if ($user) {
            return response()->json([
                'succes' => true,
                'user' => $user,
                'token' => $token,
            ],200);
        }

        return response()->json([
            'succes' => false,
        ], 409);
    }
}
