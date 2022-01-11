<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function login(Request $request){
        $user = User::where('email', $request->username)->first();

        if ($user) {
            if (password_verify($request->password, $user->password)) {
                return response()->json([
                    'data' => [
                        'id' => $user->id,
                        'token' => $user->token,
                        'nama' => $user->nama,
                        'email' => $user->email,
                        'kontak' => $user->kontak,
                    ]
                ]);;
            }
            return null;
            
        }
        return null;
    }

    public function profile(Request $request){
        $user = User::where('user.token',$request->token)->get();

        return response()->json(['dataUser' => $user]);
    }

    public function register(Request $request){
        //nama, email, password
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|unique:user',
            'password' => 'required|min : 6',
            'kontak' => 'required',

        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }

        $user = User::create([
            'email' => $request->email,
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'password' => bcrypt($request->password),
            'token' => Str::random(60),
        ]);

        if ($user) {
            return response()->json($user);            
        }

        return $this->error('Regis Gagal');

    }
    
    public function error($pesan){
        return response()->json([
            'error' => $pesan
        ]);

    }

}
