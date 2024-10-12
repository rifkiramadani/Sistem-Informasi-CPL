<?php

namespace App\Models;

use App\Models\Cpl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cpmk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function cpl() {
        return $this->hasMany(Cpl::class);
    }
}
