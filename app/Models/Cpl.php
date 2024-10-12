<?php

namespace App\Models;

use App\Models\Cpmk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cpl extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function cpmk() {
        return $this->belongsTo(Cpmk::class);
    }
}
