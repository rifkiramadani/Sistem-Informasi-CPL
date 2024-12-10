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
      'nilai'
    ];

    public function rumusanMahasiswa() {
        return $this->belongsTo(RumusanMahasiswa::class);
    }

    public function rumusanCplCpmk() {
        return $this->belongsTo(RumusanCplCpmk::class);
    }
}