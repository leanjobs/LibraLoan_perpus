<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            if ($user->role_status == 'admin') {
                return redirect('/perpus');
            } elseif ($user->role_status == 'petugas') {
                return redirect('/perpus');
            } elseif ($user->role_status == 'user') {
                return redirect('/dashboard');
            } else {
                dd('error');
            }
        };
        return redirect('/login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function register(Request $request)
    {
        try {
            $user = $request->validate([
                'name' => 'required|string',
                'email' => 'required',
                'password' =>  'required|min:8',

            ]);


            $user['role_status'] = $request->input('role_status', 'user');

            $user = User::create($user);
            // return response()->json([
            //     'message' => 'berhasil tambah buku',
            //     'data' => $user
            // ]);
            // return
            return redirect()->route('userview')->with('success', 'kategori buku berhasil ditambahkan');
        } catch (Exception $e) {
            //return response()->json([
            //    'message' => 'Gagal menambah bukuuu ' . $e->getMessage()
            //], 500);
            return redirect()->route('regis')->with('success', 'kategori buku berhasil ditambahkan');
        }
    }
}
