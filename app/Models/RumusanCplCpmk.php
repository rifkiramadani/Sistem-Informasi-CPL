<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumusanCplCpmk extends Model
{
    use HasFactory;

    protected $fillable = [
        'rumusan_cpl_id',
        'cpmk_id'
    ];

    public function rumusanCpl()
    {
        $this->belongsTo(RumusanCpl::class);
    }

    public function cpmk() {
        $this->belongsTo(Cpmk::class);
    }
}