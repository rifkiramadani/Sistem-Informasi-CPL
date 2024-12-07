<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RumusanDosen extends Model
{
    use HasFactory;

    // If you're using Laravel's convention for pivot table,
    // there's no need to specify the table name, but you can add it if required.
    protected $table = 'rumusan_dosens';

    // You may want to protect any sensitive columns.
    protected $guarded = ['id'];

    // Relationship to Rumusan model
    public function rumusan()
    {
        return $this->belongsTo(Rumusan::class);
    }

    // Relationship to Dosen model
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function rumusanMahasiswas()
    {
        return $this->HasMany(RumusanMahasiswa::class);
    }
}