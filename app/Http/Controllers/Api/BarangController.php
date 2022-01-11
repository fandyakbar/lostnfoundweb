<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\model\User;
use App\model\Barang;
use App\model\Kategori;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    //
    public function index(){

        $barang = DB::table('barang')->leftjoin('user','id','=','barang.id_penemu')
                                    ->where('status',0)
                                    ->orderBy('barang.updated_at', 'DESC')
                                    ->get();

        //$user = DB::table('users')->where('name', 'John')->first();

        //$user_id = Auth::guard('api') -> user()->id;

        $response = new \stdClass();
        $response -> tanggal = Carbon::now()->toDateString();
        $response -> jumlahdata = 0;

        $response -> barang = $barang;

        return response()->json($response);
        
    }

    public function claim(Request $request){

        Barang::where('barang.id_barang',$request->id_barang)->update(['status'=>1]);

        return response()->json([
            'message' => 'Yeayy Barang Telah Ditemukan!'
        ]);
    }

    public function add(Request $request){
        $jumlah = Barang::count();
        $barang_id = $jumlah+1;

        $validasi = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'id_kartegori' => 'required',
            'deskripsi' => 'required',
            'lokasi' => 'required',

        ]);

        $barang = Barang::create([
            
            'id_barang' => $jumlah,
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'id_penemu' => $request->id_penemu,
            'status' => '0',
            'id_kategori' => 4,
            'gambar' => 'default.png',

        ]);

        if ($barang) {
            return response()->json([
                'pesan' => 'Selamat Barang temuanmu berhasil ditambahkan'
            ]);           
        }

        return $this->error('Gagal Menambahkan Barang, cek lagi');
    }
}
