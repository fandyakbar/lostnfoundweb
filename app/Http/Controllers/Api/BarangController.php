<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\model\User;
use App\model\Barang;
use App\model\Kategori;

class BarangController extends Controller
{
    //
    public function index(){

        $barang = DB::table('barang')->where('status',0)->get();

        //$user = DB::table('users')->where('name', 'John')->first();

        //$user_id = Auth::guard('api') -> user()->id;

        $response = new \stdClass();
        $response -> tanggal = Carbon::now()->toDateString();
        $response -> jumlahdata = 0;

        $response -> barang = $barang;

        return response()->json($response);
        
    }
}
