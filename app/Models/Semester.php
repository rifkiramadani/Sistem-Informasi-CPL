<?php

namespace App\Models;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function mataKuliahs() {
        return $this->hasMany(Mata_kuliah::class);
    }

    public function mahasiswas() {
        return $this->hasMany(Mahasiswa::class);
    }
}