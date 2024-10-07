<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CplController extends Controller
{
    public function index() {
        return view('cpl.index');
    }
}
