<?php

namespace App\Http\Controllers\Api\KR;

use App\Models\Keluhan;
use App\Models\Ruangan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class KeluhanController extends Controller
{

    public function getDataRuangan(Request $request)
    {
        $ruangan = Ruangan::with('user')->where('user_id', $request->user_id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Data ruangan',
            'data' => $ruangan,
        ], 200);
    }

    public function ajukanKeluhan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_ruangan' => 'required',
            'id_user' => 'required',
            'tanggal' => 'required',
            'judul_kendala' => 'required',
            'kendala' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:6000', 
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->fails(), 422]);
        }

            $foto_kendala = $request->file('image');
            $extensions = $foto_kendala->getClientOriginalExtension();
            $photokendala = Str::random(10).".".$extensions;
            $uploadPath = env('UPLOAD_PATH')."/users";

        //create Keluhan
        $keluhan = Keluhan::create([
            'id_ruangan' => $request->id_ruangan,
            'id_user' => $request->id_user,
            'tanggal' => $request->tanggal,
            'judul_kendala' => $request->judul_kendala,
            'kendala' => $request->kendala,
            'image' => $request->file('image')->move($uploadPath, $photokendala),
        ]);

        if ($keluhan) {
            return response()->json([
                'success' => true,
                'message' => 'Keluhan berhasil ditambahkan',
                'data' => $keluhan,
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Keluhan gagal ditambahkan',
        ], 409);
    }

    public function listKeluhan(Request $request)
    {
        $keluhan = Keluhan::where('id_user', $request->id_user)->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Keluhan',
            'data' => $keluhan,
        ], 200);
    }

    public function detailKeluhan($id)
    {
        $keluhan = Keluhan::with('ruangan')->with('user')->find($id);
        return response()->json([
            'success' => true,
            'message' => 'Detail Keluhan',
            'data' => $keluhan,
        ], 200);
    }
}
