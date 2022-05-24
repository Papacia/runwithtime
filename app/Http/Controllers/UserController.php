<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function Registrasi(Request $request)
    {
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt( $request['password']),
        ]);
        # code...
    }

    public function login(Request $request){
        if(Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password,
            ]
        )) {
            $user = Auth::user();

            $token = $user->createToken($user->name)->accessToken;
            $data['user'] = $user;
            $data['token'] = $token;

            return response()->json([

                'success' => true,
                'data' => $data,
                'pesan' => 'Login Berhasil',
                'token' => $token,

            ], 200);
        # code...
    } else {
        return response()->json([
            'success' => false,
            'data' => '',
            'pesan' => 'Login Gagal'
        ], 401);
    }
    //}
    }

    public function LogOut(){
        Auth::LogOut();
    }
}