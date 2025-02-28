<?php

namespace App\Http\Controllers\SPA;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends \App\Http\Controllers\Controller
{
    public function login(Request $request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 400);
        }
        if (!auth()->attempt($request->only('username', 'password'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Username or Password is incorrect'
            ], 401);
        }
        $user = User::where('username', $request->username)->first();
        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'status' => 'success',
            'message' => 'Login Success',
            'data' => [
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer'
            ]
        ], 200);
    }

    public function getProfile(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'User Profile',
            'data' => [
                'id' => $user->id,
                'nama' => $user->petugas->name,
                'nik' => $user->petugas->nik,
                'email' => $user->petugas->email,
                'penugasan' => $user->penugasan,
                'no_hp' => $user->petugas->no_telp,
                'alamat' => $user->petugas->alamat,
                // 'foto' => $user->foto,
                'username' => $user->username
            ]
        ], 200);
    }
    public function updateProfile(Request $request)
    {
        $rules = [
            'nama' => 'required',
            // 'nik' => 'required',
            'email' => 'required',
            // 'penugasan' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'username' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 400);
        }
        DB::beginTransaction();
        try {
            $user = User::find(auth('sanctum')->user()->id);
            $user->petugas->name = $request->nama;
            // $user->petugas->nik = $request->nik;
            $user->petugas->email = $request->email;
            // $user->penugasan = $request->penugasan;
            $user->petugas->no_telp = $request->no_hp;
            $user->petugas->alamat = $request->alamat;
            $user->username = $request->username;
            $user->save();
            $user->petugas->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Profile has been updated',
            'data' => [
                'id' => $user->id,
                'nama' => $user->petugas->name,
                'nik' => $user->petugas->nik,
                'email' => $user->petugas->email,
                'penugasan' => $user->penugasan,
                'no_hp' => $user->petugas->no_telp,
                'alamat' => $user->petugas->alamat,
                // 'foto' => $user->foto,
                'username' => $user->username
            ]
        ], 200);
    }
    public function resetPassword($request)
    {
        $rules = [
            'password' => 'required',
            'new_password' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 400);
        }
        $user = User::find(auth()->user()->id);
        $user->password = bcrypt($request->new_password);
        $user->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Password has been changed'
        ], 200);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logout Success'
        ], 200);
    }
}
