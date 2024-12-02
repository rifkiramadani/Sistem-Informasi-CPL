<?php

namespace App\Models;

use App\Models\Cpmk;
use App\Models\Mata_kuliah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rumusan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function mata_kuliah()
    {
        return $this->belongsTo(Mata_kuliah::class, 'mata_kuliah_id');
    }

    public function rumusanCpls() {
        return $this->belongsToMany(Cpl::class, 'rumusans_cpl', 'rumusan_id', 'cpl_id');
    }

    public function cplCpmks() {
        return $this->belongsToMany(Cpmk::class, 'rumusans_cpl_cpmk', 'cpmk_id', 'skor_maks');
    }

    // public function cpls()
    // {
    //     return $this->belongsToMany(Cpl::class, 'rumusan_cpl_cpmk', 'rumusan_id', 'cpl_id')
    //                 ->withPivot('cpmk_id', 'skor_maks')
    //                 ->withTimestamps();
    // }

    // public function cplCpmks()
    // {
    //     return $this->belongsToMany(Cpmk::class, 'rumusan_cpl_cpmk', 'rumusan_id', 'cpmk_id')
    //                 ->withPivot('cpl_id', 'skor_maks')
    //                 ->withTimestamps();
    // }
    
}
