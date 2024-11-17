<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index() {
        return view('mahasiswa.index', [
            'mahasiswas' => Mahasiswa::all(),
        ]);
    }
}
