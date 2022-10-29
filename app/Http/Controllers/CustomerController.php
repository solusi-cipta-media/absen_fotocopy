<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customers = Customer::all();
            return DataTables::of($customers)
                ->addIndexColumn()
                ->addColumn('klasifikasi', function($row){
                    if ($row->klasifikasi == 'rental') {
                        return '<span class="badge bg-warning">Rental</span>';
                    }elseif ($row->klasifikasi == 'kontrak') {
                        return '<span class="badge bg-primary">Kontrak</span>';
                    }else{
                        return '<span class="badge bg-success">Beli</span>';
                    }
                })
                ->addColumn('lokasi', function($row){
                    return '<a href="https://www.google.com/maps/place/'.$row->latitude.','.$row->longitude.'" target="_blank" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Lokasi Map">
                                <i class="fa fa-map"></i>
                            </a>';
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
                ->rawColumns(['klasifikasi', 'lokasi', 'action'])
                ->make(true);
        }
        return view('customer');
    }

    public function get($id)
    {
        $customer = Customer::find($id);
        return response()->json(['data' => $customer],200);
    }

    public function generateCode()
    {
        $kode = Customer::max('kode');
        if (!isset($kode)) {
            return response()->json(['data' => 'C-0001'],200);
        }
        $maxnum = substr($kode,2);
        $num = str_pad($maxnum+1, 4, '0', STR_PAD_LEFT);
        return response()->json(['data' => 'C-'.$num],200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kode' => 'required|unique:customers,kode',
            'nama' => 'required|min:2',
            'alamat' => 'required',
            'klasifikasi' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'kontak_nama' => 'required',
            'kontak_telepon' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()],400);
        }

        $customer = new Customer;
        $customer->kode = $request->kode;
        $customer->nama = $request->nama;
        $customer->alamat = $request->alamat;
        $customer->klasifikasi = $request->klasifikasi;
        $customer->latitude = $request->latitude;
        $customer->longitude = $request->longitude;
        $customer->kontak_nama = $request->kontak_nama;
        $customer->kontak_telepon = $request->kontak_telepon;
        $customer->save();

        return response()->json(['message' => 'Data telah ditambahkan'],201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'kode' => 'required|unique:customers,kode,'.$id,
            'nama' => 'required|min:2',
            'alamat' => 'required',
            'klasifikasi' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'kontak_nama' => 'required',
            'kontak_telepon' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()],400);
        }

        $customer = Customer::find($id);
        $customer->kode = $request->kode;
        $customer->nama = $request->nama;
        $customer->alamat = $request->alamat;
        $customer->klasifikasi = $request->klasifikasi;
        $customer->latitude = $request->latitude;
        $customer->longitude = $request->longitude;
        $customer->kontak_nama = $request->kontak_nama;
        $customer->kontak_telepon = $request->kontak_telepon;
        $customer->save();

        return response()->json(['message' => 'Data telah diupdate'],200);
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return response()->json(['message' => 'Data telah dihapus']);
    }

    public function select(Request $request)
    {
        $search = $request->search;

        if($search == ''){
            $customers = Customer::orderby('nama','asc')->select('id','nama')->limit(5)->get();
        }else{
            $customers = Customer::orderby('nama','asc')->select('id','nama')->where('nama', 'like', '%' .$search . '%')->limit(5)->get();
        }

        $response = [];
        foreach ($customers as $customer) {
            $response[] = array(
                "id"=>$customer->id,
                "text"=>$customer->nama
           );
        }
        
        return response()->json($response);
    }

}
