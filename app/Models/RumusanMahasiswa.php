<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumusanMahasiswa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Define the relationship to Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    // Define the relationship to RumusanDosen
    public function rumusanDosen()
    {
        return $this->belongsTo(RumusanDosen::class);
    }
}