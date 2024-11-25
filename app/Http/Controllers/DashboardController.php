<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Cpmk;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Rumusan;
use App\Models\Operator;
use App\Models\Mahasiswa;
use App\Models\Mata_kuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        return view('dashboard.index', [
            'admin' => Admin::count(),
            'operator' => Operator::count(),
            'dosen' => Dosen::count(),
            'mahasiswa' => Mahasiswa::count(),
            'cpmk' => Cpmk::count(),
            'cpl' => Cpl::count(),
            'matakuliah' => Mata_kuliah::count(),
            'rumusan' => Rumusan::count(),
        ]);
    }
}
