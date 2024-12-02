<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumusanCpl extends Model
{
    use HasFactory;

    protected $table = 'rumusan_cpl';

    protected $fillable = [
        'rumusan_id',
        'cpl_id'
    ];

    public function rumusan(){
        $this->belongsTo(Rumusan::class);
    }
    public function cpl(){
        $this->belongsTo(Cpl::class);
    }

    public function rumusanCplCpmks() {
        $this->hasMany(RumusanCplCpmk::class);
    }
}