<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthentikasiController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ];
        $data = $request->all();

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }
        $data['password'] = Hash::make($request->input('password'));

        $user = User::create($data);
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'register berhasil',
            'data' => $user,
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $data = $request->all();

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $email = $request->input('email');
        $password = $request->input('password');

        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return response()->json([
                'status' => 'error',
                'message' => 'gagal login',
            ], 400);
        }
        $token = auth()->user()->createToken('token')->plainTextToken;
        return response()->json([
            'status' => 'success',
            'message' => 'berhasil login',
            'data' => $data,
            'token' => $token
        ], 400);
    }
}
