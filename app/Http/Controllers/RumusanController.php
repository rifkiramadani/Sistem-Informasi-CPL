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
        return view('rumusan.index', [
            'rumusans' => Rumusan::all()
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
                    foreach ($request->cpmk_id[$cpl_id] as $cpmk_id) {
                        // Handle skor_maks based on cpl_id and cpmk_id
                        $skor_maks = $request->skor_maks[$cpl_id][$cpmk_id] ?? null;

                        // Create the RumusanCplCpmk with the associated Skor Maks
                        RumusanCplCpmk::create([
                            'rumusan_cpl_id' => $rumusanCpl->id,
                            'cpmk_id' => $cpmk_id,
                            'skor_maks' => $skor_maks,
                        ]);
                    }
                }
            }

            // Commit the transaction
            \DB::commit();

            return redirect()->route('rumusan.index')->with('success', 'Rumusan has been successfully created!');
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error('Error occurred while creating Rumusan:', ['error' => $e]);
            return back()->withErrors(['error' => 'Something went wrong! Please try again.']);
        }
    }

    public function edit($id)
    {
        $rumusan = Rumusan::findOrFail($id);

        return view('rumusan.edit', [
            'rumusan' => $rumusan,
            'mata_kuliahs' => Mata_kuliah::all(),
            'cpls' => Cpl::all(),
            'cpmks' => Cpmk::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'cpl_id' => 'required|array',
            'cpmk_id' => 'required|array',
            'skor_maks' => 'required|array',
        ]);

        // Fetch the rumusan to update
        $rumusan = Rumusan::findOrFail($id);
        $rumusan->mata_kuliah_id = $request->mata_kuliah_id;

        \DB::beginTransaction();

        try {
            // Save the rumusan (it could be updated directly since we already set the mata_kuliah_id)
            $rumusan->save();

            // Delete previous associations
            $rumusan->rumusanCpls->each(function ($rumusanCpl) {
                $rumusanCpl->rumusanCplCpmks()->delete();
            });

            // Delete the rumusanCpl entries (this removes the CPL associations)
            $rumusan->rumusanCpls()->delete();

            // Loop through the selected CPL and associated CPMK
            foreach ($request->cpl_id as $cpl_id) {
                $rumusanCpl = RumusanCpl::create([
                    'rumusan_id' => $rumusan->id,
                    'cpl_id' => $cpl_id,
                ]);

                // For each CPL, create the associated CPMK
                if (isset($request->cpmk_id[$cpl_id])) {
                    foreach ($request->cpmk_id[$cpl_id] as $cpmk_id) {
                        // Handle skor_maks based on cpl_id and cpmk_id
                        $skor_maks = $request->skor_maks[$cpl_id][$cpmk_id] ?? null;

                        // Create the RumusanCplCpmk with the associated Skor Maks
                        RumusanCplCpmk::create([
                            'rumusan_cpl_id' => $rumusanCpl->id,
                            'cpmk_id' => $cpmk_id,
                            'skor_maks' => $skor_maks,
                        ]);
                    }
                }
            }

            // Commit the transaction
            \DB::commit();

            return redirect()->route('rumusan.index')->with('success', 'Rumusan has been successfully updated!');
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error('Error occurred while updating Rumusan:', ['error' => $e]);
            return back()->withErrors(['error' => 'Something went wrong! Please try again.']);
        }
    }


    public function destroy($id)
    {
        $rumusan = Rumusan::findOrFail($id);

        // Hapus data rumusan
        $rumusan->delete();

        return redirect('/rumusan')->with('success', 'Data Rumusan Berhasil Dihapus');
    }
}