<?php

namespace App\Models;

use App\Models\Cpmk;
use App\Models\Mata_kuliah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cpl extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function cpmks() {
        return $this->belongsToMany(Cpmk::class, 'cpl_cpmk', 'cpl_id', 'cpmk_id');
    }

    public function matakuliahs() {
        return $this->belongsToMany(Mata_kuliah::class, 'matakuliah_cpl', 'mata_kuliah_id', 'cpl_id');
    }
}
