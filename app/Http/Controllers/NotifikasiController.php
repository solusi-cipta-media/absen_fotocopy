<?php

namespace App\Http\Controllers;

use App\Models\Kontrak;
use App\Models\Notifikasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NotifikasiController extends Controller
{
    public function load()
    {
        $kontraks = Kontrak::where('reminder', '>', Carbon::now()->subDay(30))->where('reminder', '<=', Carbon::now())->orderBy('reminder', 'DESC')->get();
        $counted = 0;
        foreach ($kontraks as $kontrak) {
            if (Notifikasi::where('kontrak_id', $kontrak->id)->where('tanggal', $kontrak->reminder)->count() == 0) {
                Notifikasi::create([
                    'kontrak_id' => $kontrak->id,
                    'pesan' => 'Kontrak dengan <strong>'.$kontrak->customer->nama.'</strong> akan segera berakhir pada '.Carbon::createFromFormat('Y-m-d', $kontrak->akhir)->format('d F Y'),
                    'tanggal' => $kontrak->reminder
                ]);
            }
        }
        $notifs = Notifikasi::where('tanggal', '>', Carbon::now()->subDay(30))->where('tanggal', '<=', Carbon::now())->orderBy('tanggal', 'DESC')->take(8)->get();
        $data = [];
        foreach ($notifs as $notif) {
            if ($notif->tanggal >= Carbon::now()->subDay()) {
                $notif->waktu = 'Today';
            }else{
                $notif->waktu = Carbon::createFromFormat('Y-m-d', $notif->tanggal)->diffForHumans();
            }
            array_push($data, [
                'id' => $notif->id,
                'pesan' => $notif->pesan,
                'waktu' => $notif->waktu,
            ]);
        }

        return response()->json(['data'=>$data],200);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $notifikasis = Notifikasi::orderBy('tanggal', 'DESC')->get();
            return DataTables::of($notifikasis)
                ->addIndexColumn()
                ->addColumn('waktu', function ($row)
                {
                    if ($row->tanggal >= Carbon::now()->subDay()) {
                        $row->waktu = 'Today';
                    }else{
                        $row->waktu = Carbon::createFromFormat('Y-m-d', $row->tanggal)->diffForHumans();
                    }
                    return $row->waktu;
                })
                ->rawColumns(['pesan'])
                ->make(true);
        }
        return view('notifikasi');
    }
}
