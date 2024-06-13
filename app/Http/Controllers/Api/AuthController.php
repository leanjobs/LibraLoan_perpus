<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->where('role_status', 'user')->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken('userLogin')->plainTextToken;
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }

    public function profile()
    {
        return response()->json(Auth::user());
    }
    public function updateUser(Request $request, $id){
        try {
            $user = $request->validate([
                'name' => 'required|string',
                'email' => 'required',
                'password' =>  'required|min:8',

            ]);
            $user['role_status'] = $request->input('role_status', 'user');

            $find = User::findOrFail($id);
            $find->update($user);
            return response()->json([
                'message' => 'berhasil update buku',
                'data' => $user
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'gagal update user',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
