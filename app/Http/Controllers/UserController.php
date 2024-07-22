<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user()
    {
        $users = User::where('role_status', 'user')->get();
        return view('perpus.user.index', compact('users'));
    }
    public function createUser(Request $request)
    {
        try {
            $user = $request->validate([
                'name' => 'required|string',
                'email' => 'required',
                'password' =>  'required|min:8',

            ]);

            if ($request->file('image')) {
                $user['image'] = $request->file('image')->store('user-images');
            };
            $user['role_status'] = $request->input('role_status', 'user');

            $user = User::create($user);
            // return response()->json([
            //     'message' => 'berhasil tambah buku',
            //     'data' => $user
            // ]);
            return redirect()->route('daftar_user')->with('success', 'kategori buku berhasil ditambahkan');
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal menambah bukuuu ' . $e->getMessage()
            ], 500);
        }
    }
    public function showUser()
    {
        return User::all();
    }

    public function showUserById($id)
    {
        return User::find($id);
    }
    public function updateUser(Request $request, $id)
    {
        try {
            $user = $request->validate([
                'name' => 'required|string',
                'email' => 'required',
                'password' =>  'required|min:8',

            ]);

            if ($request->file('image')) {
                $user['image'] = $request->file('image')->store('user-images');
            };

            $user['role_status'] = $request->input('role_status', 'user');

            $find = User::findOrFail($id);
            $find->update($user);
            // return response()->json([
            //     'message' => 'berhasil update buku',
            //     'data' => $user
            // ]);
            return redirect()->route('daftar_user')->with('success', 'kategori buku berhasil diupdate');
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal update bukuuu ' . $e->getMessage()
            ], 500);
        }
    }
    public function deleteUser($id)
    {
        try {
            $user = User::destroy($id);

            if ($user) {
                //return "user berhasil dihapus";
                return redirect()->route('daftar_user')->with('success', 'user berhasil delete');
            } else {
                throw new Exception("tidak ada user denga id $id");
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function petugas()
    {
        $users = User::where('role_status', 'petugas')->get();
        return view('perpus.petugas.index', compact('users'));
    }
    public function createPetugas(Request $request)
    {
        try {
            $user = $request->validate([
                'name' => 'required|string',
                'email' => 'required',
                'password' =>  'required|min:8',

            ]);


            $user['role_status'] = $request->input('role_status', 'petugas');

            $user = User::create($user);
            // return response()->json([
            //     'message' => 'berhasil tambah buku',
            //     'data' => $user
            // ]);
            return redirect()->route('daftar_petugas')->with('success', 'kategori buku berhasil ditambahkan');
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal menambah bukuuu ' . $e->getMessage()
            ], 500);
        }
    }
    public function showPetugas()
    {
        return User::all();
    }

    public function showPetugasById($id)
    {
        return User::find($id);
    }
    public function updatePetugas(Request $request, $id)
    {
        try {
            $user = $request->validate([
                'name' => 'required|string',
                'email' => 'required',
                'password' =>  'required|min:8',

            ]);
            $user['role_status'] = $request->input('role_status', 'petugas');

            $find = User::findOrFail($id);
            $find->update($user);
            // return response()->json([
            //     'message' => 'berhasil update buku',
            //     'data' => $user
            // ]);
            return redirect()->route('daftar_petugas')->with('success', 'kategori buku berhasil diupdate');
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal update bukuuu ' . $e->getMessage()
            ], 500);
        }
    }
    public function deletePetugas($id)
    {
        try {
            $user = User::destroy($id);

            if ($user) {
                //return "user berhasil dihapus";
                return redirect()->route('daftar_petugas')->with('success', 'user berhasil delete');
            } else {
                throw new Exception("tidak ada user denga id $id");
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
