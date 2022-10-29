<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProfilController extends Controller
{
    public function index()
    {
        return view('profil');
    }

    public function update_user_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:karyawans,email,' . auth()->user()->id,
            'nama' => 'required|min:2',
            'foto' =>  'nullable|file|mimes:png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = auth()->user();

        if ($request->file()) {
            if (File::exists($user->foto)) {
                File::delete($user->foto);
            }

            $file = $request->file('foto');
            $name = $file->hashName(); // Generate a unique, random name...
            $imageName = $name;
            $img = Image::make($file->path());

            // resize image
            $img->fit(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save('media/karyawan/' . $imageName);

            $user->foto = 'media/karyawan/' . $imageName;
        }

        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->save();

        return response()->json(['message' => 'Data telah ditambahkan', 'data' => $user], 200);
    }

    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'npassword' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $user = auth()->user();
        if (Hash::check($request->password, $user->password)) {
            $user->password = Hash::make($request->npassword);
            $user->save();
            return response()->json(['message' => 'Data telah diupdate'], 200);
        }
        return response()->json(['message' => 'Gagal mengubah data'], 400);
    }

    public function update_informasi_pribadi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = auth()->user();
        $user->nama = $request->nama;
        $user->alamat = $request->alamat;
        $user->telepon = $request->telepon;
        $user->save();

        return response()->json(['message' => 'Data telah diupdate', 'data' => $user->nama], 200);
    }
}
