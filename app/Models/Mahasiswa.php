<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Semester;
use App\Models\Mata_kuliah;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function semester() {
        return $this->belongsTo(Semester::class);
    }

    public function mataKuliahs() {
        return $this->HasMany(Mata_kuliah::class);
    }
    public function rumusanMahasiswas() {
        return $this->HasMany(RumusanMahasiswa::class);
    }
}