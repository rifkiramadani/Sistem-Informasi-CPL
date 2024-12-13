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
            'cpls' => Cpl::paginate(5),
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
        ]);

        $cpl = Cpl::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
        ]);

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
        ]);

        $cpl = Cpl::findOrFail($id);

        $cpl->update([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect('/cpl')->with('success', 'Data CPL Berhasil Di Ubah');
    }

    public function destroy($id) {
        $cpl = Cpl::findOrFail($id);

        $cpl->delete();

        return redirect('/cpl')->with('success', 'Data CPL Berhasil Di Hapus');
    }

    public function search(Request $request) {
        if($request->has('search')) {
            $cpl = Cpl::where('name','LIKE','%'.$request->search.'%')->paginate(5)->withQueryString();
        } else {
            $cpl = Cpl::paginate(5); 
        }

        return view('cpl.index',[
            'cpls' => $cpl
        ]);
    }
}
