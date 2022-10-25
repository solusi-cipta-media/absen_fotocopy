<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class PeriodeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $periodes = Periode::orderBy('tanggal', 'DESC')->get();
            return DataTables::of($periodes)
                ->addIndexColumn()
                ->addColumn('tanggal', function ($row){
                    $data = Carbon::createFromFormat('Y-m-d', $row->tanggal)->format('d-M-Y');
                    return $data;
                })
                ->addColumn('status', function($row){
                    if ($row->status == 'aktif') {
                        return '<span class="badge bg-success">Aktif</span>';
                    }else{
                        return '<span class="badge bg-danger">Libur</span>';
                    }
                })
                ->addColumn('action', function ($row)
                {
                    $btndel = '<button type="button" class="btn btn-sm btn-danger" onclick="delete_data('.$row->id.')" data-bs-toggle="tooltip" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>';
                    return $btndel;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }

        return view('periode');
    }

    public function store(Request $request)
    {
        $periode = new Periode;
        $periode->tanggal = $request->tanggal;
        $periode->status = $request->status;
        $periode->save();

        return response()->json(['message' => 'Data telah ditambahkan'],200);
    }


    public function destroy($id)
    {
        $periode = Periode::find($id);
        $periode->delete();
        
        return response()->json(['message' => 'Data telah dihapus'],200);
    }
}
