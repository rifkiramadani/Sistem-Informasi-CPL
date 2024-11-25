<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Cpmk;
use App\Models\Rumusan;
use App\Models\Mata_kuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RumusanController extends Controller
{
   public function index() {
//    $rumusan =  Rumusan::with(['mata_kuliah', 'cpls', 'cplCpmks'])->get();
//    dd($rumusan);
    return view('rumusan.index', [
        'rumusans' =>  Rumusan::with(['mata_kuliah', 'cpls', 'cplCpmks'])->get()
    ]);
   }

   public function create() {
    return view('rumusan.create', [
        'matakuliahs' => Mata_kuliah::all(),
        'cpls' => Cpl::all(),
        'cpmks' => Cpmk::all()
    ]);
   }

   public function store(Request $request) {
    // Validasi input
    $validated = $request->validate([
        'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
        'cpl_id' => 'required|array',
        'cpmk_id' => 'required|array',
        'skor_maks' => 'array',
        'cpl_id.*' => 'exists:cpls,id',
        'cpmk_id.*' => 'exists:cpmks,id',
        'skor_maks.*' => 'nullable|numeric|min:0',
    ]);

    // Buat data rumusan baru
    $rumusan = Rumusan::create([
        'mata_kuliah_id' => $request->mata_kuliah_id,
    ]);

    // Loop untuk memasukkan data ke tabel pivot
    foreach ($request->cpl_id as $cplId) {
        foreach ($request->cpmk_id[$cplId] ?? [] as $key => $cpmkId) {
            $skorMaks = $request->skor_maks[$cpmkId] ?? 0;

            // Menambahkan data ke tabel pivot
            $rumusan->cplCpmks()->attach($cpmkId, [
                'cpl_id' => $cplId,
                'skor_maks' => $skorMaks,
            ]);
        }
    }

    return redirect('/rumusan')->with('success', 'Data Rumusan Berhasil Ditambahkan');
}

   public function edit($id) {
    return view('rumusan.edit',[
        'rumusan' =>  Rumusan::with(['mata_kuliah', 'cpls', 'cplCpmks'])->findOrFail($id),
        'mata_kuliahs' => Mata_kuliah::all(),
        'cpls' => Cpl::all(),
        'cpmks' => Cpmk::all() 
    ]);
   }

   public function update(Request $request, $id) {
    // Validasi input
    $validated = $request->validate([
        'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
        'cpl_id' => 'required|array',
        'cpmk_id' => 'required|array',
        'skor_maks' => 'array',
        'cpl_id.*' => 'exists:cpls,id',
        'cpmk_id.*' => 'exists:cpmks,id',
        'skor_maks.*' => 'nullable|numeric|min:0',
    ]);

    // Ambil data rumusan yang akan diupdate
    $rumusan = Rumusan::findOrFail($id);
    $rumusan->mata_kuliah_id = $request->mata_kuliah_id;
    $rumusan->save();

    // Hapus relasi lama di pivot
    $rumusan->cplCpmks()->detach();

    // Tambahkan data baru ke tabel pivot
    foreach ($request->cpl_id as $cplId) {
        foreach ($request->cpmk_id[$cplId] ?? [] as $cpmkId) {
            $skorMaks = $request->skor_maks[$cpmkId] ?? 0;

            // Menambahkan data baru ke pivot
            $rumusan->cplCpmks()->attach($cpmkId, [
                'cpl_id' => $cplId,
                'skor_maks' => $skorMaks,
            ]);
        }
    }

    return redirect('/rumusan')->with('success', 'Data Rumusan Berhasil Diubah');
}

    public function destroy($id) {
        $rumusan = Rumusan::findOrFail($id);

        // Hapus relasi pivot terlebih dahulu
        $rumusan->cplCpmks()->detach();

        // Hapus data rumusan
        $rumusan->delete();

        return redirect('/rumusan')->with('success', 'Data Rumusan Berhasil Dihapus');
        }
    }
