<?php

namespace App\Http\Controllers;

use App\Models\Cpmk;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CpmkController extends Controller
{
    public function index() {
        return view('cpmk.index', [
            'cpmks' => Cpmk::all()
        ]);
    }

    public function create() {
        return view('cpmk.create');
    }

    public function store(Request $request) {
        $validate = $request->validate([
            'name' => 'required',
            'deskripsi' => 'required',
            'skor_maks' => 'required|numeric'
        ]);

        Cpmk::create([
            'name'=>$request->name,
            'deskripsi'=>$request->deskripsi,
            'skor_maks'=>$request->skor_maks
        ]);

        return redirect('/cpmk')->with('success', 'Tambah Data CPMK Berhasil');
    }

    public function edit($id) {
        return view('cpmk.edit', [
            'cpmk' => Cpmk::find($id),
        ]);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required',
            'deskripsi' => 'required',
            'skor_maks' => 'required|numeric'
        ]);

        $cpmk = Cpmk::findOrFail($id);

        $cpmk->update([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'skor_maks' => $request->skor_maks
        ]);

        return redirect('/cpmk')->with('success', 'Ubah data CPMK Berhasil');
    }

    public function destroy($id) {
        $cpmk = Cpmk::findOrFail($id);
        $cpmk->delete();
        return redirect('/cpmk')->with('success', 'Data CPMK Berhasil Di Hapus');
    }
}

