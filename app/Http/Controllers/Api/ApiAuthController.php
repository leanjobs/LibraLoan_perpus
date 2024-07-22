<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->email)->where('role_status', 'user')->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ], 403);
            }

            return response([
                'user' => $user,
                'token' => $user->createToken('userLogin')->plainTextToken
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function register(Request $request)
    {
        $user = $request->validate([
            'name' => 'required|string',
            'email' => 'required',
            'password' =>  'required|min:8',

        ]);


        $user['role_status'] = $request->input('role_status', 'user');

        $user = User::create($user);
        return response([
            'user' => $user,
            'token' => $user->createToken('userLogin')->plainTextToken
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }

    public function profile()
    {

        return response()->json(Auth::user());
    }
    public function updateUser(Request $request, $id)
    {
        try {
            $user = $request->validate([
                'name' => 'string',
                'email' => 'string|email',
                'password' => 'string|min:8',

            ]);
            $user['role_status'] = $request->input('role_status', 'user');

            $find = User::findOrFail($id);
            $find->save($user);
            return response([
                'message' => 'berhasil update user',
                'data' => $user
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'gagal update user',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
