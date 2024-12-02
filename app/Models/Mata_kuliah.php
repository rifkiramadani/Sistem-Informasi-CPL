<?php

namespace App\Models;

use App\Models\Cpl;
use App\Models\Dosen;
use App\Models\Semester;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mata_kuliah extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function semesters() {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function rumusan() {
        return $this->hasMany(Mata_kuliah::class);
    }

    public function dosen() {
        return $this->belongsToMany(Dosen::class, 'dosen_mata_kuliah', 'dosen_id', 'mata_kuliah_id');
    }

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class);
    }
}