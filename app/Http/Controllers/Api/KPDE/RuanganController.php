<?php

namespace App\Http\Controllers\Api\KPDE;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RuanganController extends Controller
{

    public function listKR()
    {
        $kr = User::where('jabatan_id', '2')->get();

        return response()->json([
            'success' => true,
            'message' => 'List Kepala Ruangan',
            'data' => $kr,
        ]);
    }

    public function addRoom(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kd_ruangan' => 'required|unique:ruangans',
            'nama_ruangan' => 'required',
            'user_id' => 'required|unique:ruangans'
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors(), 422]);
        }

        //create ruangan
        $room = Ruangan::create([
            'kd_ruangan' => $request->kd_ruangan,
            'nama_ruangan' => $request->nama_ruangan,
            'user_id' => $request->user_id,
        ]);

        if ($room) {
            return response()->json([
                'success' => true,
                'message' => 'Ruangan Berhasil di tambahkan',
                'data' => $room,
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Ruangan gagal ditambahkan',
        ], 409);
    }

    public function listRoom()
    {
        $room = Ruangan::all();

        return response()->json([
            'success' => true,
            'message' => 'List data ruangan',
            'data' => $room,
        ], 200);
    }

    public function detailRoom($id)
    {
        $room = Ruangan::with('user')->find($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Ruangan',
            'data' => $room,
        ], 200);
    }

    public function ubahRoom(Request $request, $id)
    {
        $room = Ruangan::findOrFail($id);

        $room->update([
            'kd_ruangan' => $request->kd_ruangan,
            'nama_ruangan' => $request->nama_ruangan,
            'user_id' => $request->user_id,
        ]);

        if ($room) {
            return response()->json([
                'success' => true,
                'message' => 'Data ruangan berhasil diubah',
                'data' => $room,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data ruangan gagal diubah'
        ], 409);
    }

    public function hapusRoom($id)
    {
        $room = Ruangan::findOrFail($id);

        if ($room->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'data ruangan berhasil di hapus',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'data ruangan gagal di hapus'
        ]);
    }
}
