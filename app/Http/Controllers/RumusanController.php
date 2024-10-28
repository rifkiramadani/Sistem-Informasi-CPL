<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Mata_kuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RumusanController extends Controller
{
    public function index() {
        return view('rumusan.index',[
            'matakuliahs' => Mata_kuliah::all(),
            'cpls' => Cpl::all(),
        ]);
    }
}
