<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\AbsensiKetidakhadiran;
use App\Models\Karyawan;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $absensis = Absensi::with(['periode'])
                ->whereRelation('periode', 'tanggal', '>=', Carbon::now()->subDays(30))
                ->whereRelation('periode', 'tanggal', '<=', Carbon::now())->get();

            return DataTables::of($absensis)
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
                ->addColumn('clock', function ($row) {
                    $time = substr($row->clock_in, 0, 5);
                    $btn = '<button class="btn btn-sm btn-success" onclick="open_foto(' . $row->id . ', `in`)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                                    <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg> 
                                ' . $time . '
                            </button>
                            <a id="link_in' . $row->id . '" href="' . asset($row->foto_in) . '" style="display:none;"></a>';

                    if (!isset($row->clock_out)) {
                        return $btn;
                    }
                    $time = substr($row->clock_out, 0, 5);
                    $btnout = '<button class="btn btn-sm btn-danger" onclick="open_foto(' . $row->id . ',`out`)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg>
                                ' . $time . '
                            </button>
                            <a id="link_out' . $row->id . '" href="' . asset($row->foto_out) . '" style="display:none;"></a>';
                    return $btn . $btnout;
                })
                ->addColumn('lokasi', function ($row) {
                    $btn = '<a href="https://www.google.com/maps/place/' . $row->lat_in . ',' . $row->long_in . '" target="_blank" class="btn btn-sm btn-success" data-bs-toggle="tooltip" title="Lokasi Map">
                                <i class="fa fa-map"></i> IN
                            </a>';
                    if (!isset($row->clock_out)) {
                        return $btn;
                    }
                    return $btn . '<a href="https://www.google.com/maps/place/' . $row->lat_out . ',' . $row->long_out . '" target="_blank" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Lokasi Map">
                                <i class="fa fa-map"></i> OUT
                            </a>';
                })
                ->addColumn('terlambat', function ($row) {
                    if (strtotime($row->periode->clock_in) < strtotime($row->clock_in)) {
                        $timeawal = (strtotime($row->clock_in) - strtotime($row->periode->clock_in)) / 60;
                        $time = date("i:s", $timeawal);
                        return $time;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('pulang', function ($row) {
                    if (!isset($row->clock_out)) {
                        return ' - ';
                    }
                    if (strtotime($row->periode->clock_out) > strtotime($row->clock_out)) {
                        $timeawal = (strtotime($row->periode->clock_out) - strtotime($row->clock_out)) / 60;
                        $time = date("i:s", $timeawal);
                        return $time;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('work', function ($row) {
                    if (isset($row->clock_out)) {
                        $timeawal = (strtotime($row->clock_out) - strtotime($row->clock_in)) / 60;
                        $time = date("i:s", $timeawal);
                        return $time;
                    } else {
                        return ' - ';
                    }
                })
                ->rawColumns(['clock', 'lokasi'])
                ->make(true);
        }

        return view('absensi');
    }

    public function indexDate(Request $request, $data)
    {
        if ($request->ajax()) {
            $date = explode(" to ", $data);
            $from = Carbon::createFromFormat('d-F-Y', $date[0])->format('Y-m-d');
            $to = Carbon::createFromFormat('d-F-Y', $date[1])->format('Y-m-d');
            $absensis = Absensi::with('periode')
                ->whereRelation('periode', 'tanggal', '>=', $from)
                ->whereRelation('periode', 'tanggal', '<=', $to)->get();

            return DataTables::of($absensis)
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
                ->addColumn('clock', function ($row) {
                    $time = substr($row->clock_in, 0, 5);
                    $btn = '<button class="btn btn-sm btn-success" onclick="open_foto(' . $row->id . ', `in`)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                                    <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg> 
                                ' . $time . '
                            </button>
                            <a id="link_in' . $row->id . '" href="' . asset($row->foto_in) . '" style="display:none;"></a>';

                    if (!isset($row->clock_out)) {
                        return $btn;
                    }
                    $time = substr($row->clock_out, 0, 5);
                    $btnout = '<button class="btn btn-sm btn-danger" onclick="open_foto(' . $row->id . ',`out`)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg>
                                ' . $time . '
                            </button>
                            <a id="link_out' . $row->id . '" href="' . asset($row->foto_out) . '" style="display:none;"></a>';
                    return $btn . $btnout;
                })
                ->addColumn('lokasi', function ($row) {
                    $btn = '<a href="https://www.google.com/maps/place/' . $row->lat_in . ',' . $row->long_in . '" target="_blank" class="btn btn-sm btn-success" data-bs-toggle="tooltip" title="Lokasi Map">
                                <i class="fa fa-map"></i> IN
                            </a>';
                    if (!isset($row->clock_out)) {
                        return $btn;
                    }
                    return $btn . '<a href="https://www.google.com/maps/place/' . $row->lat_out . ',' . $row->long_out . '" target="_blank" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Lokasi Map">
                                <i class="fa fa-map"></i> OUT
                            </a>';
                })
                ->addColumn('terlambat', function ($row) {
                    if (strtotime($row->periode->clock_in) < strtotime($row->clock_in)) {
                        $timeawal = (strtotime($row->clock_in) - strtotime($row->periode->clock_in)) / 60;
                        $time = date("i:s", $timeawal);
                        return $time;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('pulang', function ($row) {
                    if (!isset($row->clock_out)) {
                        return ' - ';
                    }
                    if (strtotime($row->periode->clock_out) > strtotime($row->clock_out)) {
                        $timeawal = (strtotime($row->periode->clock_out) - strtotime($row->clock_out)) / 60;
                        $time = date("i:s", $timeawal);
                        return $time;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('work', function ($row) {
                    if (isset($row->clock_out)) {
                        $timeawal = (strtotime($row->clock_out) - strtotime($row->clock_in)) / 60;
                        $time = date("i:s", $timeawal);
                        return $time;
                    } else {
                        return ' - ';
                    }
                })
                ->rawColumns(['clock', 'lokasi'])
                ->make(true);
        }
    }

    public function clock_in(Request $request)
    {
        $periode = Periode::where('tanggal', Carbon::today()->toDateString())->first();

        if ($periode->status == 'libur') {
            return response()->json(['message' => 'Tidak dapat melakukan absen di hari libur'], 400);
        }

        if (AbsensiKetidakhadiran::where('periode_id', $periode->id)->where('karyawan_id', auth()->user()->id)->where('status', 'approved')->count() > 0) {
            return response()->json(['message' => 'Tidak dapat melakukan absen. Anda memiliki pengajuan cuti yang sudah disetujui.'], 400);
        }

        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' => 'required',
            'image' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = auth()->user();
        if (Absensi::where('periode_id', $periode->id)->where('karyawan_id', $user->id)->count() > 0) {
            return response()->json(['message' => 'Anda sudah melakukan absen masuk'], 400);
        }

        $folderPath = "media/absensi/kehadiran/in/";

        $base64Image = explode(";base64,", $request->image);
        $explodeImage = explode("image/", $base64Image[0]);
        $imageType = $explodeImage[1];
        $image_base64 = base64_decode($base64Image[1]);
        $file = $folderPath . uniqid() . '.' . $imageType;

        file_put_contents($file, $image_base64);

        Absensi::create([
            'karyawan_id' => $user->id,
            'periode_id' => $periode->id,
            'lat_in' => $request->latitude,
            'long_in' => $request->longitude,
            'clock_in' => Carbon::now('Asia/Jakarta')->format('H:i:m'),
            'foto_in' => $file
        ]);

        return response()->json(['message' => 'Berhasil melakukan absensi masuk'], 200);
    }

    public function clock_out(Request $request)
    {
        $periode = Periode::where('tanggal', Carbon::today()->toDateString())->first();

        if ($periode->status == 'libur') {
            return response()->json(['message' => 'Tidak dapat melakukan absen di hari libur'], 400);
        }

        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' => 'required',
            'image' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = auth()->user();
        if (Absensi::where('periode_id', $periode->id)->where('karyawan_id', $user->id)->count() == 0) {
            return response()->json(['message' => 'Anda belum melakukan absen masuk'], 400);
        }

        $absensi = Absensi::where('periode_id', $periode->id)->where('karyawan_id', $user->id)->first();
        if (isset($absensi->clock_out)) {
            return response()->json(['message' => 'Anda sudah melakukan absen keluar'], 400);
        }

        $folderPath = "media/absensi/kehadiran/out/";

        $base64Image = explode(";base64,", $request->image);
        $explodeImage = explode("image/", $base64Image[0]);
        $imageType = $explodeImage[1];
        $image_base64 = base64_decode($base64Image[1]);
        $file = $folderPath . uniqid() . '.' . $imageType;

        file_put_contents($file, $image_base64);

        $absensi->clock_out = Carbon::now('Asia/Jakarta')->format('H:i:m');
        $absensi->lat_out = $request->latitude;
        $absensi->long_out = $request->longitude;
        $absensi->foto_out = $file;
        $absensi->save();

        return response()->json(['message' => 'Berhasil melakukan absensi masuk'], 200);
    }

    public function indexAlpha(Request $request)
    {
        $periodes = Periode::where('status', 'aktif')->whereBetween('tanggal', [Carbon::now()->subDays(30), Carbon::now()])->get();
        $karyawans = Karyawan::all();
        $data = [];
        foreach ($periodes as $periode) {
            foreach ($karyawans as $karyawan) {
                if (Absensi::where('karyawan_id', $karyawan->id)->where('periode_id', $periode->id)->count() == 0) {
                    array_push($data, [
                        'nama' => $karyawan->nama,
                        'nip' => $karyawan->nip,
                        'tanggal' => $periode->tanggal,
                    ]);
                }
            }
        }
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('nama', function ($row) {
                    return $row['nama'];
                })
                ->addColumn('nip', function ($row) {
                    return $row['nip'];
                })
                ->addColumn('tanggal', function ($row) {
                    $data = Carbon::createFromFormat('Y-m-d', $row['tanggal'])->format('d-F-Y');
                    return $data;
                })
                ->addColumn('clock', function ($row) {
                    return '-';
                })
                ->addColumn('lokasi', function ($row) {
                    return '-';
                })
                ->addColumn('terlambat', function ($row) {
                    return '-';
                })
                ->addColumn('pulang', function ($row) {
                    return '-';
                })
                ->addColumn('work', function ($row) {
                    return '-';
                })
                ->make(true);
        }
    }

    public function indexAlphaDate(Request $request, $date)
    {
        $date = explode(" to ", $date);
        $from = Carbon::createFromFormat('d-F-Y', $date[0])->format('Y-m-d');
        $to = Carbon::createFromFormat('d-F-Y', $date[1])->format('Y-m-d');
        $periodes = Periode::where('status', 'aktif')->whereBetween('tanggal', [$from, $to])->get();
        $karyawans = Karyawan::all();
        $data = [];
        foreach ($periodes as $periode) {
            foreach ($karyawans as $karyawan) {
                if (Absensi::where('karyawan_id', $karyawan->id)->where('periode_id', $periode->id)->count() == 0) {
                    array_push($data, [
                        'nama' => $karyawan->nama,
                        'nip' => $karyawan->nip,
                        'tanggal' => $periode->tanggal,
                    ]);
                }
            }
        }
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('nama', function ($row) {
                    return $row['nama'];
                })
                ->addColumn('nip', function ($row) {
                    return $row['nip'];
                })
                ->addColumn('tanggal', function ($row) {
                    $data = Carbon::createFromFormat('Y-m-d', $row['tanggal'])->format('d-F-Y');
                    return $data;
                })
                ->addColumn('clock', function ($row) {
                    return '-';
                })
                ->addColumn('lokasi', function ($row) {
                    return '-';
                })
                ->addColumn('terlambat', function ($row) {
                    return '-';
                })
                ->addColumn('pulang', function ($row) {
                    return '-';
                })
                ->addColumn('work', function ($row) {
                    return '-';
                })
                ->make(true);
        }
    }
}
