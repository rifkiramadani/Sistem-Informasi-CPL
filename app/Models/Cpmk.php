<?php

namespace App\Models;

use App\Models\Rumusan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cpmk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function rumusans()
    {
        return $this->belongsToMany(Rumusan::class, 'rumusan_cpl_cpmk', 'cpmk_id', 'rumusan_id')
                    ->withPivot('cpl_id', 'skor_maks')
                    ->withTimestamps();
    }
    
}
