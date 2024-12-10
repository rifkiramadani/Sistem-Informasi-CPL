<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumusanCplCpmk extends Model
{
    use HasFactory;

    protected $table = 'rumusan_cpl_cpmks';

    protected $fillable = [
        'rumusan_cpl_id',
        'cpmk_id',
        'skor_maks'
    ];

    public function rumusanCpl()
    {
        return $this->belongsTo(RumusanCpl::class);
    }

    public function cpmk() {
        return $this->belongsTo(Cpmk::class);
    }

    public function rumusan_mahasiswa_nilais()
    {
        return $this->hasMany(RumusanMahasiswaNilai::class);
    }
}