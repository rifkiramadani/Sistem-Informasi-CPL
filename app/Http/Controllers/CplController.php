<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Cpmk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CplController extends Controller
{
    public function index() {
        return view('cpl.index',[
            'cpls' => Cpl::all(),
        ]);
    }

    public function create() {
        return view('cpl.create', [
            'cpmks' => Cpmk::all(),
        ]);
    }

    public function store(Request $request) {
        // dd($request->all());

        $validated = $request->validate([
            'name' => 'required|unique:cpls,name',
            'deskripsi' => 'required',
            'cpmk_id' => 'required|array',
            'cpmk_id.*' => 'numeric'
        ]);

        $cpl = Cpl::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
        ]);

        //menambahkan banyak cpmk ke cpl
        $cpl->cpmk()->attach($request->cpmk_id);

        return redirect('/cpl')->with('success', 'Tambah Data CPL Berhasil');
    }

    public function edit($id) {
        return view('cpl.edit', [
            'cpl' => Cpl::find($id),
            'cpmks' => Cpmk::all()
        ]);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required',
            'deskripsi' => 'required',
            'cpmk_id' => 'required|array',
            'cpmk_id.*' => 'numeric'
        ]);

        $cpl = Cpl::findOrFail($id);

        $cpl->update([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
        ]);

         // Sinkronisasi CPMK (update relation)
        $cpl->cpmks()->sync($request->cpmk_id);

        return redirect('/cpl')->with('success', 'Data CPL Berhasil Di Ubah');
    }

    public function destroy($id) {
        $cpl = Cpl::findOrFail($id);

        $cpl->delete();

        return redirect('/cpl')->with('success', 'Data CPL Berhasil Di Hapus');
    }
}
