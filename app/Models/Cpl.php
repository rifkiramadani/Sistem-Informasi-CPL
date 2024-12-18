<?php

namespace App\Models;

use App\Models\Rumusan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cpl extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function rumusans()
    {
        return $this->belongsToMany(Rumusan::class, 'rumusan_cpl_cpmk', 'cpl_id', 'rumusan_id')
                    ->withPivot('cpmk_id', 'skor_maks')
                    ->withTimestamps();
    }

    public function rumusanCpls()
    {
        return $this->hasMany(RumusanCpl::class);
    }
}