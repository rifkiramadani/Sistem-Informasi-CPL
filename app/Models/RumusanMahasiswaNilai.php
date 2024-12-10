<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumusanMahasiswaNilai extends Model
{
    use HasFactory;

    protected $fillable = [
      'rumusan_mahasiswa_id',
      'rumusan_cpl_cpmk_id',
    ];

    public function rumusan_mahasiswa() {
        return $this->belongsTo(RumusanMahasiswa::class);
    }

    public function rumusan_cpl_cpmk() {
        return $this->belongsTo(RumusanCplCpmk::class);
    }
}