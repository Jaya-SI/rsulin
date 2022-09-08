<?php

namespace App\Http\Controllers\Api\KPDE;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function inverif()
    {
        $karyawans = User::where('verifikasi', '0')->get();

        return response()->json([
            'success' => true,
            'Data' => $karyawans,
        ], 200);
    }

    public function verifikasiKaryawan(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'jabatan_id' => $request->jabatan_id,
            'verifikasi' => $request->verifikasi,
        ]);

        return response()->json([
            'succes' => true,
            'message' => 'Data Karyawan Berhasil Terverifikasi',
            'data' => $user,
        ], 200);
    }

    public function listKaryawan()
    {
        $karyawans = User::with('jabatan')->where('verifikasi', '1')->get();

        return response()->json([
            'success' => true,
            'Data' => $karyawans,
        ], 200);
    }

    public function detailKarywan($id)
    {
        $karyawan = User::with('jabatan')->find($id);

        if ($karyawan) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Karyawan',
                'data' => $karyawan,
            ], 200);
        }

        return response()->json([
            'succes' => false,
            'message' => 'Data karyawan tidak ada',
        ], 409);
    }

    public function ubahDataKaryawan(Request $request, $id)
    {
        $karyawan = User::findOrFail($id);

        //check user upload gambar ?
        if ($request->hasFile('image')) {
            //hapus foto lama
            Storage::disk('upload')->delete('public/uploads/users'.basename($karyawan->image));

            //upload foto baru
            $foto_user = $request->file('image');
            $extensions = $foto_user->getClientOriginalExtension();
            $fotoKaryawan = 'users/'.Str::random(10).'.'.$extensions;
            $uploadPath = env('UPLOAD_PATH').'/users';

            $karyawan->update([
                'image' => $request->file('image')->move($uploadPath, $fotoKaryawan),
                'nip' => $request->nip,
                'jabatan_id' => $request->jabatan_id,
                'nama' => $request->nama,
                'tgl_lahir' => $request->tgl_lahir,
                'jk' => $request->jk,
                'nohp' => $request->nohp,
                'alamat' => $request->alamat,
            ]);
        }

        $karyawan->update([
            'nip' => $request->nip,
            'jabatan_id' => $request->jabatan_id,
            'name' => $request->name,
            'tgl_lahir' => $request->tgl_lahir,
            'jk' => $request->jk,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
        ]);

        if ($karyawan) {
            return response()->json([
                'success' => true,
                'message' => 'Data Karyawan Berhasil di Update',
                'data' => $karyawan,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data Karyawan Gagal di Update',
        ], 409);
    }

    public function hapusKaryawan($id)
    {
        $karyawan = User::findOrFail($id);

        //hapus image
        Storage::disk('upload')->delete('users/'.basename($karyawan->image));

        //jika berhasil di hapus
        if ($karyawan->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Karyawan Berhasil di hapus'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'Karyawan Berhasil gagal di hapus'
        ], 409);
    }
}
