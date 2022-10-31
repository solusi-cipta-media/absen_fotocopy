<?php

namespace App\Http\Controllers;

use App\Models\Mesin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MesinController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $mesins = Mesin::all();
            return DataTables::of($mesins)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    if ($row->status == 'import') {
                        return '<span class="badge bg-warning">Import</span>';
                    }elseif ($row->status == 'overhaul') {
                        return '<span class="badge bg-danger">Overhaul</span>';
                    }else{
                        return '<span class="badge bg-success">Ready</span>';
                    }
                })
                ->addColumn('action', function ($row)
                {
                    $btndel = '<button type="button" class="btn btn-sm btn-danger" onclick="delete_data('.$row->id.')" data-bs-toggle="tooltip" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>';
                    $btnedit = '<button type="button" class="btn btn-sm btn-info" onclick="open_form('.$row->id.')" data-bs-toggle="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </button>';
                    return $btndel.$btnedit;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('mesin');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nomor' => 'required|unique:mesins,nomor',
            'serial' => 'required|unique:mesins,serial',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()],400);
        }

        Mesin::create([
            'nomor' => $request->nomor,
            'serial' => $request->serial,
            'model' => $request->model,
            'asal' => $request->asal,
            'meter' => $request->meter,
            'tegangan' => $request->tegangan,
            'status' => $request->status
        ]);

        return response()->json(['message' => 'Data telah ditambahkan'],200);
    }

    public function destroy($id)
    {
        $mesin = Mesin::find($id);
        $mesin->delete();
        return response()->json(['message' => 'Data telah di hapus']);
    }

    public function get($id)
    {
        $mesin = Mesin::find($id);
        return response()->json(['data' => $mesin],200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'nomor' => 'required|unique:mesins,nomor,'.$id,
            'serial' => 'required|unique:mesins,serial,'.$id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()],400);
        }

        $mesin = Mesin::find($id);
        $mesin->update([
            'nomor' => $request->nomor,
            'serial' => $request->serial,
            'model' => $request->model,
            'asal' => $request->asal,
            'meter' => $request->meter,
            'tegangan' => $request->tegangan,
            'status' => $request->status
        ]);

        return response()->json(['message' => 'Data telah diupdate'],200);
    }
}
