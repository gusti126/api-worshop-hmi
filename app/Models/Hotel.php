<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'thumbnail', 'alamat', 'deskripsi'
    ];

    public function hotel()
    {
        return $this->hasMany('App\Models\ImageHotel');
    }
}
