<?php

namespace App\Http\Controllers\Api\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\ImageHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            'hotel_id' => 'required',
            'image' => 'required',
        ];
        $data = $request->all();

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $hotelId = $request->input('hotel_id');
        $hotel = Hotel::find($hotelId);
        if (!$hotel) {
            return response()->json([
                'status' => 'error',
                'message' => 'data id hotel not found'
            ], 404);
        }

        $image = $request->file('image')->store(
            'assets/hotel/image',
            'public'
        );
        $data['image'] =
            url('storage/' . $image);

        $image_hotel = ImageHotel::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'berhasil create data image hotel',
            'data' => $image_hotel
        ], 201);
    }
}
