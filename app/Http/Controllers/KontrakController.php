<?php

namespace App\Http\Controllers;

use App\Models\Kontrak;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class KontrakController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $kontraks = Kontrak::all();
            return DataTables::of($kontraks)
            ->addIndexColumn()
            ->addColumn('customer', function ($row){
                return $row->customer->nama;
            })
            ->addColumn('awal', function ($row){
                $data = Carbon::createFromFormat('Y-m-d', $row->awal)->format('d-M-Y');
                return $data;
            })
            ->addColumn('akhir', function ($row){
                $data = Carbon::createFromFormat('Y-m-d', $row->akhir)->format('d-M-Y');
                return $data;
            })
            ->addColumn('reminder', function ($row){
                $data = Carbon::createFromFormat('Y-m-d', $row->reminder)->format('d-M-Y'); 
                return $data;
            })
            ->addColumn('pdf', function ($row)
            {
                return '<button type="button" onclick="openPdf('.$row->id.')" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Lihat</button><a id="link_pdf'.$row->id.'" href="'.asset($row->pdf).'" style="display:none;"></a>';
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
            ->rawColumns(['pdf','action'])
            ->make(true);
        }

        return view('kontrak');
    }

    public function store(Request $request){
        $kontrak = new Kontrak;
        $kontrak->customer_id = $request->customer_id;
        $kontrak->nomor = $request->nomor;
        $kontrak->awal = $request->awal;
        $kontrak->akhir = $request->akhir;
        $kontrak->reminder = $request->reminder;

        $file = $request->file('pdf');
        $name = $file->hashName();
        $file->move('media/kontrak', $name);

        $kontrak->pdf = 'media/kontrak/'.$name;
        $kontrak->save();

        return response()->json(['message'=>'Data telah ditambahkan'],200);
    }

    public function update(Request $request, $id){
        $kontrak = Kontrak::find($id);
        $kontrak->customer_id = $request->customer_id;
        $kontrak->nomor = $request->nomor;
        $kontrak->awal = $request->awal;
        $kontrak->akhir = $request->akhir;
        $kontrak->reminder = $request->reminder;

        if ($request->file()) {
            if(File::exists($kontrak->pdf)){
                File::delete($kontrak->pdf);
            }
            $file = $request->file('pdf');
            $name = $file->hashName();
            $file->move('media/kontrak', $name);
            $kontrak->pdf = 'media/kontrak/'.$name;
        }

        $kontrak->save();

        return response()->json(['message'=>'Data telah diupdate'],200);
    }

    public function get($id){
        $kontrak = Kontrak::find($id);

        return response()->json(['data' => $kontrak, 'message' => 'success'], 200);
    }

    public function destroy($id){

        $kontrak = Kontrak::find($id);
        if(File::exists($kontrak->pdf)){
            File::delete($kontrak->pdf);
        }
        $kontrak->delete();
        return response()->json(['message', 'Data berhasil dihapus'],200);
    }
}
