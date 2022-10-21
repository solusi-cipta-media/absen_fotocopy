<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CutiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cuti = Cuti::all();
            return DataTables::of($cuti)
                ->addIndexColumn()
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
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('cuti');
    }

    public function get($id)
    {
        $cuti = Cuti::find($id);
        return response()->json(['data' => $cuti],200);
    }

    public function store(Request $request)
    {
        $cuti = new Cuti;
        $cuti->nama = $request->nama;
        $cuti->waktu = $request->waktu;
        $cuti->save();

        return response()->json(['message' => 'Data telah ditambahkan'],200);
    }

    public function update(Request $request, $id)
    {
        $cuti = Cuti::find($id);
        $cuti->nama = $request->nama;
        $cuti->waktu = $request->waktu;
        $cuti->save();

        return response()->json(['message' => 'Data telah diupdate'],200);
    }

    public function destroy($id)
    {
        $cuti = Cuti::find($id);
        $cuti->delete();
        
        return response()->json(['message' => 'Data telah dihapus'],200);
    }
}
