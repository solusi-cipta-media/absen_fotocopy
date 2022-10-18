<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KaryawanController extends Controller
{
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
                    $btndel = '<button type="button" class="btn btn-sm btn-danger" onclick="delete_data()" data-bs-toggle="tooltip" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>';
                    $btnedit = '<button type="button" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Edit" id="btn-edit">
                                    <i class="fa fa-edit"></i>
                                </button>';
                    return $btndel.$btnedit;
                })
                ->rawColumn(['foto', 'action'])
                ->make(true);
        }
        return view('karyawan');
    }
}
