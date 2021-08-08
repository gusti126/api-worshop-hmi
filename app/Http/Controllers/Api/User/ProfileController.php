<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $user = User::where('id', $userId)->with('profile')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'berhasil tampilkan profile',
            'data' => $user
        ], 200);
    }

    public function update(Request $request)
    {
        $userId = Auth::user()->id;
        $profile = Profile::where('user_id', $userId)->first();

        $data = $request->all();

        if ($request->file('image')) {
            $image = $request->file('image')->store(
                'assets/user/profile',
                'public'
            );
            $data['image'] =
                url('storage/' . $image);
        }

        $profile->update(
            $data
        );

        $user = User::where('id', $userId)->with('profile')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'sukses update profile',
            'data' => $user
        ], 200);
    }
}
