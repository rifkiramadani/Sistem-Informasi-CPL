<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\RumusanMahasiswaNilai;
use Illuminate\Http\Request;

class RumusanMahasiswaNilaiController extends Controller
{
    /**
     * Show the form to edit Nilai for a specific Mahasiswa.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        // Fetch RumusanMahasiswaNilai for this Mahasiswa
        $rumusanMahasiswaNilais = $mahasiswa->rumusanMahasiswas->flatMap(function ($rumusanMahasiswa) {
            return $rumusanMahasiswa->rumusanMahasiswaNilais;
        });

        return view('mahasiswa.nilai_edit', compact('mahasiswa', 'rumusanMahasiswaNilais'));
    }

    /**
     * Update Nilai for a specific Mahasiswa.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        // Validate input
        $request->validate([
            'nilai' => 'required|array',  // Array of nilai values to update
            'nilai.*' => 'numeric|min:0',  // Ensure nilai is a number and within valid range
        ]);

        // Iterate over the RumusanMahasiswaNilai records and update them
        foreach ($request->nilai as $id => $nilai) {
            $rumusanMahasiswaNilai = RumusanMahasiswaNilai::findOrFail($id);

            // Check if the nilai exceeds the skor_maks for the related RumusanCplCpmk
            if ($nilai > $rumusanMahasiswaNilai->rumusanCplCpmk->skor_maks) {
                return back()->withErrors(['nilai' => 'Nilai cannot exceed the maximum score (' . $rumusanMahasiswaNilai->rumusanCplCpmk->skor_maks . ')']);
            }

            // Update the nilai
            $rumusanMahasiswaNilai->update(['nilai' => $nilai]);
        }

        return redirect()->route('mahasiswa.show', $mahasiswa->id)
            ->with('success', 'Nilai updated successfully!');
    }
}