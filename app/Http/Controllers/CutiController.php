<?php

namespace App\Http\Controllers;

use App\Models\AbsensiKetidakhadiran;
use App\Models\Cuti;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;

class CutiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cuti = Cuti::all();
            return DataTables::of($cuti)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btndel = '<button type="button" class="btn btn-sm btn-danger" onclick="delete_data(' . $row->id . ')" data-bs-toggle="tooltip" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>';
                    $btnedit = '<button type="button" class="btn btn-sm btn-info" onclick="open_form(' . $row->id . ')" data-bs-toggle="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </button>';
                    return $btndel . $btnedit;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('cuti');
    }

    public function get($id)
    {
        $cuti = Cuti::find($id);
        return response()->json(['data' => $cuti], 200);
    }

    public function store(Request $request)
    {
        $cuti = new Cuti;
        $cuti->nama = $request->nama;
        $cuti->waktu = $request->waktu;
        $cuti->save();

        return response()->json(['message' => 'Data telah ditambahkan'], 200);
    }

    public function update(Request $request, $id)
    {
        $cuti = Cuti::find($id);
        $cuti->nama = $request->nama;
        $cuti->waktu = $request->waktu;
        $cuti->save();

        return response()->json(['message' => 'Data telah diupdate'], 200);
    }

    public function destroy($id)
    {
        $cuti = Cuti::find($id);
        $cuti->delete();

        return response()->json(['message' => 'Data telah dihapus'], 200);
    }

    public function pengajuanindex()
    {
        $cutis = Cuti::all();
        $data = AbsensiKetidakhadiran::where('karyawan_id', auth()->user()->id)->orderBy('created_at', 'DESC')->limit(15)->get();
        return view('pengajuancuti', ['cutis' => $cutis, 'data' => $data]);
    }

    public function pengajuanStore(Request $request)
    {
        if (Periode::where('tanggal', $request->tanggal)->where('status', 'aktif')->count() == 0) {
            return response()->json(['message' => 'Tidak dapat membuat pengajuan pada tanggal tersebut'], 400);
        }

        $periode = Periode::where('tanggal', $request->tanggal)->where('status', 'aktif')->first();
        if (AbsensiKetidakhadiran::where('periode_id', $periode->id)->where('karyawan_id', auth()->user()->id)->where('status', '!=', 'rejected')->count() > 0) {
            return response()->json(['message' => 'Anda sudah membuat pengajuan pada tanggal tersebut'], 400);
        }

        $ak = new AbsensiKetidakhadiran;
        if ($request->cuti != 0) {
            $ak->cuti_id = $request->cuti;
        } else {
            $file = $request->file('bukti');
            $name = $file->hashName(); // Generate a unique, random name...
            $imageName = $name;
            $img = Image::make($file->path());

            // resize image
            $img->widen(600, function ($constraint) {
                $constraint->upsize();
            })->save('media/absensi/ketidakhadiran/' . $imageName);
            $ak->bukti = 'media/absensi/ketidakhadiran/' . $imageName;
        }

        $ak->karyawan_id = auth()->user()->id;
        $ak->periode_id = $periode->id;
        $ak->status = 'waiting';
        $ak->save();

        if (isset($ak->cuti_id)) {
            $cutinama = $ak->cuti->nama;
        } else {
            $cutinama = 'Izin/Sakit';
        }

        if (isset($ak->bukti)) {
            $bukti = asset($ak->bukti);
        } else {
            $bukti = '';
        }
        $data = [
            'tanggal' => Carbon::createFromFormat('Y-m-d', $periode->tanggal)->format('d F Y'),
            'cuti' => $cutinama,
            'status' => ucfirst($ak->status),
            'bukti' => $bukti,
            'id' => $ak->id,
            'tanggal_pengajuan' => Carbon::createFromFormat('Y-m-d H:i:s', $ak->created_at)->format('d F Y')
        ];
        return response()->json(['message' => 'Berhasil membuat pengajuan', 'data' => $data], 200);
    }
}
