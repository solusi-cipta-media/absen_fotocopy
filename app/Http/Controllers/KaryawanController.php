<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;

class KaryawanController extends Controller
{
    // list karyawan
    public function index(Request $request)
    {
        //Return Datatable
        if ($request->ajax()) {
            $karyawans = Karyawan::all();
            //return response()->json(['data' => $karyawans],200);
            return DataTables::of($karyawans)
                ->addIndexColumn()
                ->addColumn('foto', function ($row){
                    $img = '<img class="img-avatar" src="'.asset($row->foto).'" alt="'.$row->nama.'">';
                    return $img;
                })
                ->addColumn('action', function ($row)
                {
                    $btndel = '<button type="button" class="btn btn-sm btn-danger" onclick="delete_data('.$row->id.')" data-bs-toggle="tooltip" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>';
                    $btnedit = '<button type="button" class="btn btn-sm btn-info" onclick="edit_data('.$row->id.')" data-bs-toggle="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </button>';
                    return $btndel.$btnedit;
                })
                ->rawColumns(['foto', 'action'])
                ->make(true);
        }
        return view('karyawan');
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|min:2',
            'nip' => 'required|unique:karyawans,nip',
            'alamat' => 'required',
            'no_ktp' => 'required|unique:karyawans,no_ktp',
            'telepon' => 'required|min:8',
            'jenis_kelamin' => 'required',
            'foto' =>  'required|file|mimes:png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $karyawan = new Karyawan;

        // foto
        $file = $request->file('foto');
        $name = $file->hashName(); // Generate a unique, random name...
        $imageName = $name;
        $img = Image::make($file->path());
        
        // resize image
        $img->fit(400, 400, function ($constraint) {
            $constraint->aspectRatio();
        })->save('media/karyawan/'.$imageName);

        $karyawan->foto = 'media/karyawan/'.$imageName;
        $karyawan->nama = $request->nama;
        $karyawan->nip = $request->nip;
        $karyawan->no_ktp = $request->no_ktp;
        $karyawan->alamat = $request->alamat;
        $karyawan->telepon = $request->telepon;
        $karyawan->jenis_kelamin = $request->jenis_kelamin;
        $karyawan->save();

        return response()->json(['message' => 'Data telah ditambahkan'],201);
    }

    // get data for edit
    public function get($id)
    {
        $karyawan = Karyawan::find($id);

        return response()->json(['data' => $karyawan, 'message' => 'success'], 200);
    }

    // update data
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|min:2',
            'nip' => 'required|unique:karyawans,nip,'.$id,
            'alamat' => 'required',
            'no_ktp' => 'required|unique:karyawans,no_ktp,'.$id,
            'telepon' => 'required|min:8',
            'jenis_kelamin' => 'required',
            'foto' =>  'nullable|file|mimes:png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // get karyawan
        $karyawan = Karyawan::find($id);

        // cek foto
        if ($request->file()) {
            if(File::exists($karyawan->foto)){
                File::delete($karyawan->foto);
            }

            $file = $request->file('foto');
            $name = $file->hashName(); // Generate a unique, random name...
            $imageName = $name;
            $img = Image::make($file->path());
            
            // resize image
            $img->fit(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save('media/karyawan/'.$imageName);

            $karyawan->foto = 'media/karyawan/'.$imageName;
        }
        
        $karyawan->nama = $request->nama;
        $karyawan->nip = $request->nip;
        $karyawan->no_ktp = $request->no_ktp;
        $karyawan->alamat = $request->alamat;
        $karyawan->telepon = $request->telepon;
        $karyawan->jenis_kelamin = $request->jenis_kelamin;
        $karyawan->save();

        return response()->json(['message' => 'Data telah diupdate'],200);
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);
        if(File::exists($karyawan->foto)){
            File::delete($karyawan->foto);
        }
        $karyawan->delete();
        return response()->json(['message' => 'Data telah di hapus']);
    }
}
