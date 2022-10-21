<?php

namespace App\Http\Controllers;

use App\Models\Kontrak;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class KontrakController extends Controller
{
    public function index(Request $request)
    {
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
                return '<button type="button" onclick="openPdf('.asset($row->pdf).')" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Lihat</button>';
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
}
