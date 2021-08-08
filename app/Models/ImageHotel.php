<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageHotel extends Model
{
    use HasFactory;
    protected $fillable = [
        'hotel_id', 'image'
    ];

    public function hotel()
    {
        return $this->belongsTo('App\Models\Hotel');
    }
}
