<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $absensis = Absensi::with(['periode' => function ($q){
                    $q->orderBy('tanggal', 'DESC');
                }])
                ->whereRelation('periode', 'tanggal', '>=', Carbon::now()->subDays(30))
                ->whereRelation('periode', 'tanggal', '<=', Carbon::now())->get();
            // if (isset($dateRange)) {
            //     $date = explode(" to ",$request->dateRange);
            //     $from = Carbon::createFromFormat('d-F-Y', $date[0])->format('Y-m-d');
            //     $to = Carbon::createFromFormat('d-F-Y', $date[1])->format('Y-m-d');
            //     $absensis = Absensi::with('periode')
            //         ->whereRelation('periode', 'tanggal', '>', $from)
            //         ->whereRelation('periode', 'tanggal', '<', $to)->get();
            // }else{
            return DataTables::of($absensis)
                ->addColumn('nama', function ($row){
                    return $row->karyawan->nama;
                })
                ->addColumn('nip', function ($row){
                    return $row->karyawan->nip;
                })
                ->addColumn('tanggal', function ($row){
                    $data = Carbon::createFromFormat('Y-m-d', $row->periode->tanggal)->format('d-F-Y'); 
                    return $data;
                })
                ->addColumn('clock_in', function ($row){
                    $time = substr($row->clock_in, 0, 5);
                    $btn = '<button class="btn btn-sm btn-light" onclick="open_foto('.$row->id.', `in`)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                            </button>'.$time.'
                            <a id="link_in'.$row->id.'" href="'.asset($row->foto_in).'" style="display:none;"></a>';
                    return $btn;
                })
                ->addColumn('clock_out', function ($row){
                    $time = substr($row->clock_out, 0, 5);
                    $btn = '<button class="btn btn-sm btn-light" onclick="open_foto('.$row->id.',`out`)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                            </button>'.$time.'
                            <a id="link_out'.$row->id.'" href="'.asset($row->foto_out).'" style="display:none;"></a>';
                    return $btn;
                })
                ->addColumn('lokasi_in', function($row){
                    return '<a href="https://www.google.com/maps/place/'.$row->lat_in.','.$row->long_in.'" target="_blank" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Lokasi Map">
                                <i class="fa fa-map"></i>
                            </a>';
                })
                ->addColumn('lokasi_out', function($row){
                    return '<a href="https://www.google.com/maps/place/'.$row->lat_out.','.$row->long_out.'" target="_blank" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Lokasi Map">
                                <i class="fa fa-map"></i>
                            </a>';
                })
                ->addColumn('terlambat', function($row){
                    if (strtotime($row->periode->clock_in) < strtotime($row->clock_in)) {
                        $timeawal = (strtotime($row->clock_in)-strtotime($row->periode->clock_in))/60;
                        $time = date("i:s",$timeawal);
                        return $time;
                    }else{
                        return '-';
                    }
                })
                ->addColumn('pulang', function($row){
                    if (strtotime($row->periode->clock_out) > strtotime($row->clock_out)) {
                        $timeawal = (strtotime($row->periode->clock_out)-strtotime($row->clock_out))/60;
                        $time = date("i:s",$timeawal);
                        return $time;
                    }else{
                        return '-';
                    }
                })
                ->addColumn('action', function($row){
                    if (strtotime($row->periode->clock_out) > strtotime($row->clock_out)) {
                        $timeawal = (strtotime($row->periode->clock_out)-strtotime($row->clock_out))/60;
                        $time = date("i:s",$timeawal);
                        return $time;
                    }else{
                        return '-';
                    }
                })
                ->rawColumns(['clock_in','clock_out','lokasi_in', 'lokasi_out'])
                ->make(true);
        }

        return view('absensi');
    }

    public function indexDate(Request $request, $data)
    {
        if ($request->ajax()) {
            $date = explode(" to ",$data);
            $from = Carbon::createFromFormat('d-F-Y', $date[0])->format('Y-m-d');
            $to = Carbon::createFromFormat('d-F-Y', $date[1])->format('Y-m-d');
            $absensis = Absensi::with(['periode' => function ($q){
                    $q->orderBy('tanggal', 'DESC');
                }])
                ->whereRelation('periode', 'tanggal', '>=', $from)
                ->whereRelation('periode', 'tanggal', '<=', $to)->get();

            return DataTables::of($absensis)
                ->addColumn('nama', function ($row){
                    return $row->karyawan->nama;
                })
                ->addColumn('nip', function ($row){
                    return $row->karyawan->nip;
                })
                ->addColumn('tanggal', function ($row){
                    $data = Carbon::createFromFormat('Y-m-d', $row->periode->tanggal)->format('d-F-Y'); 
                    return $data;
                })
                ->addColumn('clock_in', function ($row){
                    $time = substr($row->clock_in, 0, 5);
                    $btn = '<button class="btn btn-sm btn-light" onclick="open_foto('.$row->id.', `in`)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                            </button>'.$time.'
                            <a id="link_in'.$row->id.'" href="'.asset($row->foto_in).'" style="display:none;"></a>';
                    return $btn;
                })
                ->addColumn('clock_out', function ($row){
                    $time = substr($row->clock_out, 0, 5);
                    $btn = '<button class="btn btn-sm btn-light" onclick="open_foto('.$row->id.',`out`)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                            </button>'.$time.'
                            <a id="link_out'.$row->id.'" href="'.asset($row->foto_out).'" style="display:none;"></a>';
                    return $btn;
                })
                ->addColumn('lokasi_in', function($row){
                    return '<a href="https://www.google.com/maps/place/'.$row->lat_in.','.$row->long_in.'" target="_blank" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Lokasi Map">
                                <i class="fa fa-map"></i>
                            </a>';
                })
                ->addColumn('lokasi_out', function($row){
                    return '<a href="https://www.google.com/maps/place/'.$row->lat_out.','.$row->long_out.'" target="_blank" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Lokasi Map">
                                <i class="fa fa-map"></i>
                            </a>';
                })
                ->addColumn('terlambat', function($row){
                    if (strtotime($row->periode->clock_in) < strtotime($row->clock_in)) {
                        $timeawal = (strtotime($row->clock_in)-strtotime($row->periode->clock_in))/60;
                        $time = date("i:s",$timeawal);
                        return $time;
                    }else{
                        return '-';
                    }
                })
                ->addColumn('pulang', function($row){
                    if (strtotime($row->periode->clock_out) > strtotime($row->clock_out)) {
                        $timeawal = (strtotime($row->periode->clock_out)-strtotime($row->clock_out))/60;
                        $time = date("i:s",$timeawal);
                        return $time;
                    }else{
                        return '-';
                    }
                })
                ->addColumn('action', function($row){
                    if (strtotime($row->periode->clock_out) > strtotime($row->clock_out)) {
                        $timeawal = (strtotime($row->periode->clock_out)-strtotime($row->clock_out))/60;
                        $time = date("i:s",$timeawal);
                        return $time;
                    }else{
                        return '-';
                    }
                })
                ->rawColumns(['clock_in','clock_out','lokasi_in', 'lokasi_out'])
                ->make(true);
        }

        return view('absensi');
    }
}
