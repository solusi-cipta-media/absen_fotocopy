<?php

namespace App\Http\Controllers;

use App\Models\AbsensiKetidakhadiran as AK;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class AbsensiKetidakhadiranController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $ak = AK::with('periode')
                ->whereRelation('periode', 'tanggal', '>=', Carbon::now()->subDays(15))
                ->whereRelation('periode', 'tanggal', '<=', Carbon::now()->addDays(15))->get();
            return DataTables::of($ak)
                ->addIndexColumn()
                ->addColumn('nama', function ($row) {
                    return $row->karyawan->nama;
                })
                ->addColumn('nip', function ($row) {
                    return $row->karyawan->nip;
                })
                ->addColumn('tanggal', function ($row) {
                    $data = Carbon::createFromFormat('Y-m-d', $row->periode->tanggal)->format('d-F-Y');
                    return $data;
                })
                ->addColumn('cuti', function ($row) {
                    if ($row->cuti == null) {
                        return 'Izin/Sakit';
                    }
                    return $row->cuti->nama;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'approved') {
                        return '<span class="badge bg-success">Approved</span>';
                    } elseif ($row->status == 'rejected') {
                        return '<span class="badge bg-danger">Rejected</span>';
                    } else {
                        return '<span class="badge bg-warning">Waiting</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    if ($row->cuti != null) {
                        $bukti_button = '<button type="button" class="btn btn-sm btn-secondary mr-1" disabled>
                                            <i class="si si-picture"></i>
                                        </button>';
                    } else {
                        $bukti_button = '<button type="button" class="btn btn-sm btn-success mr-1" onclick="open_bukti(' . $row->id . ')">
                                            <i class="si si-picture"></i>
                                        </button><a id="link_bukti' . $row->id . '" href="' . asset($row->bukti) . '" style="display:none;"></a>';
                    }

                    if ($row->status == 'waiting') {
                        $button =   '<button type="button" class="btn btn-sm btn-primary" onclick=approve_data(' . $row->id . ')>
                                        <i class="fa fa-circle-check"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick=reject_data(' . $row->id . ')>
                                        <i class="fa fa-circle-xmark"></i>
                                    </button>';
                        return $bukti_button . ' ' . $button;
                    } else {
                        return $bukti_button;
                    }
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('absensi_ketidakhadiran');
    }

    public function indexDate(Request $request, $data)
    {
        if ($request->ajax()) {
            $date = explode(" to ", $data);
            $from = Carbon::createFromFormat('d-F-Y', $date[0])->format('Y-m-d');
            $to = Carbon::createFromFormat('d-F-Y', $date[1])->format('Y-m-d');
            $ak = AK::with('periode')
                ->whereRelation('periode', 'tanggal', '>=', $from)
                ->whereRelation('periode', 'tanggal', '<=', $to)->get();
            return DataTables::of($ak)
                ->addIndexColumn()
                ->addColumn('nama', function ($row) {
                    return $row->karyawan->nama;
                })
                ->addColumn('nip', function ($row) {
                    return $row->karyawan->nip;
                })
                ->addColumn('tanggal', function ($row) {
                    $data = Carbon::createFromFormat('Y-m-d', $row->periode->tanggal)->format('d-F-Y');
                    return $data;
                })
                ->addColumn('cuti', function ($row) {
                    if ($row->cuti == null) {
                        return 'Izin/Sakit';
                    }
                    return $row->cuti->nama;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'approved') {
                        return '<span class="badge bg-success">Approved</span>';
                    } elseif ($row->status == 'rejected') {
                        return '<span class="badge bg-danger">Rejected</span>';
                    } else {
                        return '<span class="badge bg-warning">Waiting</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    if ($row->cuti != null) {
                        $bukti_button = '<button type="button" class="btn btn-sm btn-secondary mr-1" disabled>
                                            <i class="si si-picture"></i>
                                        </button>';
                    } else {
                        $bukti_button = '<button type="button" class="btn btn-sm btn-success mr-1" onclick="open_bukti(' . $row->id . ')">
                                            <i class="si si-picture"></i>
                                        </button><a id="link_bukti' . $row->id . '" href="' . asset($row->bukti) . '" style="display:none;"></a>';
                    }

                    if ($row->status == 'waiting') {
                        $button =   '<button type="button" class="btn btn-sm btn-primary" onclick=approve_data(' . $row->id . ')>
                                        <i class="fa fa-circle-check"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick=reject_data(' . $row->id . ')>
                                        <i class="fa fa-circle-xmark"></i>
                                    </button>';
                        return $bukti_button . ' ' . $button;
                    } else {
                        return $bukti_button;
                    }
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('absensi_ketidakhadiran');
    }

    public function approve($id)
    {
        $ak = AK::find($id);
        $ak->status = 'approved';
        $ak->save();

        return response()->json(['message' => 'approved'], 200);
    }

    public function reject($id)
    {
        $ak = AK::find($id);
        $ak->status = 'rejected';
        $ak->save();

        return response()->json(['message' => 'rejected'], 200);
    }
}
