<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Semester;
use App\Models\Mata_kuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MatakuliahController extends Controller
{
    public function index() {
        return view('mataKuliah.index', [
            'matakuliahs' => Mata_kuliah::paginate(10),
        ]);
    }

    public function create() {
        return view('matakuliah.create', [
            'cpls' => Cpl::all(),
        ]);
    }

    public function store(Request $request) {
        // dd($request->all());

        $validated = $request->validate([
            'kode_matkul' => 'required',
            'name' => 'required',
        ]);

        $mataKuliah = Mata_kuliah::create([
            'kode_matkul' => $request->kode_matkul,
            'name' => $request->name,
        ]);

        return redirect('/matakuliah')->with('success', 'Tambah Mata Kuliah Berhasil');

    }

    public function edit($id) {
        return view('matakuliah.edit', [
            'matakuliah' => Mata_kuliah::find($id),
        ]);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'kode_matkul' => 'required',
            'name' => 'required',
        ]);

        $matakuliah = Mata_kuliah::findOrFail($id);

        $matakuliah->update([
            'kode_matkul' => $request->kode_matkul,
            'name' => $request->name,
        ]);

        return redirect('/matakuliah')->with('success', 'Ubah Data Mata Kuliah Berhasil');
    }

    public function destroy($id) {
        $matakuliah = Mata_kuliah::findOrFail($id);

        $matakuliah->delete();

        return redirect('/matakuliah')->with('success', 'Hapus Data Mata Kuliah Berhasil');
    }

    public function search(Request $request) {
        if($request->has('search')) {
            $matakuliah = Mata_kuliah::where('name','LIKE','%'.$request->search.'%')
            ->orWhere('kode_matkul','LIKE','%'.$request->search.'%')
            ->paginate(5)->withQueryString();
        } else {
            $matakuliah = Mata_kuliah::paginate(5); 
        }

        return view('mataKuliah.index',[
            'matakuliahs' => $matakuliah
        ]);
    }
}
