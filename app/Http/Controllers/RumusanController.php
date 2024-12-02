<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Cpmk;
use App\Models\Rumusan;
use App\Models\Mata_kuliah;
use App\Models\RumusanCpl;
use App\Models\RumusanCplCpmk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RumusanController extends Controller
{
    public function index()
    {
        //    $rumusan =  Rumusan::with(['mata_kuliah', 'cpls', 'cplCpmks'])->get();
//    dd($rumusan);
        return view('rumusan.index', [
            'rumusans' => Rumusan::with(['mata_kuliah', 'cpls', 'cplCpmks'])->get()
        ]);
    }

    public function create()
    {
        return view('rumusan.create', [
            'matakuliahs' => Mata_kuliah::all(),
            'cpls' => Cpl::all(),
            'cpmks' => Cpmk::all()
        ]);
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'cpl_id' => 'required|array',
            'cpmk_id' => 'required|array',
            'skor_maks' => 'required|array',
        ]);

        // Begin the transaction
        \DB::beginTransaction();

        try {
            // Create Rumusan
            $rumusan = Rumusan::create([
                'mata_kuliah_id' => $request->mata_kuliah_id,
            ]);

            // Loop through the selected CPL and associated CPMK
            foreach ($request->cpl_id as $cpl_id) {
                $rumusanCpl = RumusanCpl::create([
                    'rumusan_id' => $rumusan->id,
                    'cpl_id' => $cpl_id,
                ]);

                // For each CPL, create the associated CPMK
                if (isset($request->cpmk_id[$cpl_id])) {
                    foreach ($request->cpmk_id[$cpl_id] as $index => $cpmk_id) {
                        RumusanCplCpmk::create([
                            'rumusan_cpl_id' => $rumusanCpl->id,
                            'cpmk_id' => $cpmk_id,
                            'skor_maks' => $request->skor_maks[$index], // Assuming skor_maks corresponds to the order of selected cpmks
                        ]);
                    }
                }
            }

            // Commit the transaction
            \DB::commit();

            // Redirect with success message
            return redirect()->back()->with('success', 'Rumusan has been successfully created!');
        } // In your controller method's catch block
        catch (\Exception $e) {
            // Rollback the transaction if anything goes wrong
            \DB::rollback();

            // Log the exception (optional, but good for debugging)
            \Log::error('Error occurred while creating Rumusan:', ['error' => $e]);

            // Return error message with only the exception message or custom message
            return back()->withErrors(['error' => 'Something went wrong! Please try again.']);
        }

    }

    public function edit($id)
    {
        return view('rumusan.edit', [
            'rumusan' => Rumusan::with(['mata_kuliah', 'cpls', 'cplCpmks'])->findOrFail($id),
            'mata_kuliahs' => Mata_kuliah::all(),
            'cpls' => Cpl::all(),
            'cpmks' => Cpmk::all()
        ]);
    }

    public function update(Request $request, $id)
    {
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

    public function destroy($id)
    {
        $rumusan = Rumusan::findOrFail($id);

        // Hapus relasi pivot terlebih dahulu
        $rumusan->cplCpmks()->detach();

        // Hapus data rumusan
        $rumusan->delete();

        return redirect('/rumusan')->with('success', 'Data Rumusan Berhasil Dihapus');
    }
}