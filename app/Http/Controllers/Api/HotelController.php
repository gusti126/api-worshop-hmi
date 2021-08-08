<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function index()
    {
        $data = Hotel::get();

        return response()->json([
            'status' => 'success',
            'message' => 'list data hotel',
            'data' => $data
        ], 200);
    }

    public function show($id)
    {
        $data = Hotel::with('image')->find($id);
        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'data hotel not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'show detail hotel',
            'data' => $data
        ], 200);
    }

    public function create(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'thumbnail' => 'required',
            'alamat' => 'required',
            'deskripsi' => 'required',
        ];
        $data = $request->all();

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $image = $request->file('thumbnail')->store(
            'assets/hotel',
            'public'
        );
        $data['thumbnail'] =
            url('storage/' . $image);

        $hotel = Hotel::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'berhasil tambahkan data hotel',
            'data' => $hotel
        ], 201);
    }
}
