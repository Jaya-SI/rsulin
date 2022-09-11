<?php

namespace App\Http\Controllers\Api\TEKNISI;

use App\Http\Controllers\Controller;
use App\Models\Keluhan;
use App\Models\Perbaikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PerbaikanController extends Controller
{
    public function ambilPerbaikan(Request $request)
    {
        //update keluhan
        $keluhan = Keluhan::findOrFail($request->keluhan_id);
        $keluhan->update([
            'done' => '1',
        ]);
        //create perbaikan
        $perbaikan = Perbaikan::create([
            'user_id' => $request->user_id,
            'ruangan_id' => $request->ruangan_id,
            'keluhan_id' => $request->keluhan_id,
        ]);

        if ($perbaikan) {
            return response()->json([
                'success' => true,
                'message' => 'Perbaikan berhasil di ambil',
                'data' => $perbaikan,
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Perbaikan gagal di ambil',
        ], 409);
    }

    public function listPerbaikan(Request $request)
    {
        $perbaikan = Perbaikan::with('user', 'ruangan', 'keluhan')->where('response' , '0')->where('user_id', $request->user_id)->get();
        return response()->json([
            'success' => true,
            'message' => 'List perbaikan',
            'data' => $perbaikan,
        ]);
    }
}
