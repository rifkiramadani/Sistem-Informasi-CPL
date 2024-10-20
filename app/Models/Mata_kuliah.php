<?php

namespace App\Models;

use App\Models\Cpl;
use App\Models\Mata_kuliah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mata_kuliah extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function semesters() {
        return $this->belongsTo(Semester::class, 'semester_id');
    }


    public function cpls() {
        return $this->belongsToMany(Cpl::class, 'matakuliah_cpl', 'cpl_id', 'mata_kuliah_id');
    }
}
