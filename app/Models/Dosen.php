<?php

namespace App\Models;

use App\Models\User;
use App\Models\Mata_kuliah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function user() {
       return $this->belongsTo(User::class);
    }

    public function matakuliah() {
        return $this->belongsToMany(Mata_kuliah::class);
    }
}
