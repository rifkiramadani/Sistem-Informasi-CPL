<?php

namespace App\Http\Controllers;

use App\Models\RumusanDosen;
use App\Models\RumusanMahasiswaNilai;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\RumusanMahasiswa;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class MahasiswaController extends Controller
{
    // Show the list of Mahasiswa
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $mahasiswa = Mahasiswa::whereHas('user', function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('npm', 'LIKE', '%' . $request->search . '%')
                ->orWhere('email', 'LIKE', '%' . $request->search. '%');
            })->paginate(10)->withQueryString();
        } else {
            $mahasiswa = Mahasiswa::paginate(10);
        }
    
        return view('mahasiswa.index', [
            'mahasiswas' => $mahasiswa,
        ]);
    }

    // Show the form to create a new Mahasiswa
    public function create()
    {
        return view('mahasiswa.create');
    }

    // Store a new Mahasiswa and User
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|unique:mahasiswas,npm',
        ]);

        // Create User
        $username = strtolower(str_replace(' ', '_', $request->nama));
        $user = User::create([
            'username' => $username,
            'name' => $request->nama,
            'email' => $username . '@anjas.com',
            'password' => bcrypt($username),
        ]);

        // Attach the 'Mahasiswa' role
        $user->assignRole('Mahasiswa');

        // Create Mahasiswa and associate with the created User
        Mahasiswa::create([
            'user_id' => $user->id,
            'npm' => $request->npm,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa has been created successfully!');
    }

    // Show the form to edit an existing Mahasiswa
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    // Update an existing Mahasiswa and User
    public function update(Request $request, $id)
    {
        $request->validate([
            'npm' => 'required|unique:mahasiswas,npm,' . $id,
            'name' => 'required|string|max:255',
            'password' => 'nullable|min:8', // Password is optional but must be at least 8 characters if provided
        ]);

        // Fetch the Mahasiswa and associated User
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = $mahasiswa->user;

        // Update the User's details (username and email are automatically updated based on name)
        $username = strtolower(str_replace(' ', '_', $request->name));
        $user->update([
            'name' => $request->name,
            'username' => $username,
            'email' => $username . '@gmail.com',  // Sync email with username
        ]);

        // If password is provided, update it
        if ($request->filled('password')) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }

        // Update the Mahasiswa details
        $mahasiswa->update([
            'npm' => $request->npm,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa successfully updated.');
    }

    // Show the details of a specific Mahasiswa
    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Initialize an array to hold the labels, nilai, skor_maks, total values, and percentages for each RumusanMahasiswa
        foreach ($mahasiswa->rumusanMahasiswas as $rumusanMahasiswa) {
            $labels = [];
            $nilaiValues = [];
            $skorMaxValues = [];
            $percentages = [];
            $letterGrades = [];

            // Initialize sums
            $totalNilai = 0;
            $totalSkorMax = 0;

            // Loop through the RumusanMahasiswa and extract Cpmk data
            foreach ($rumusanMahasiswa->rumusanDosen->rumusan->rumusanCpls as $rumusanCpl) {
                foreach ($rumusanCpl->rumusanCplCpmks as $rumusanCplCpmk) {
                    $labels[] = $rumusanCplCpmk->cpmk->name; // Assuming you have 'name' field in Cpmk model

                    // Get the nilai from RumusanMahasiswaNilai (which should be pre-populated or edited)
                    $rumusanMahasiswaNilai = $rumusanMahasiswa->rumusanMahasiswaNilais->where('rumusan_cpl_cpmk_id', $rumusanCplCpmk->id)->first();
                    $nilai = $rumusanMahasiswaNilai ? $rumusanMahasiswaNilai->nilai : 0; // Default to 0 if no nilai is found
                    $nilaiValues[] = $nilai;

                    // Get the maximum score (skor_maks)
                    $skorMax = $rumusanCplCpmk->skor_maks;
                    $skorMaxValues[] = $skorMax;

                    // Add to total values
                    $totalNilai += $nilai;
                    $totalSkorMax += $skorMax;

                    // Calculate the percentage for this Cpmk and store it
                    $percentage = $skorMax > 0 ? ($nilai / $skorMax) * 100 : 0;
                    $percentages[] = number_format($percentage, 2); // Format to 2 decimal places

                    // Convert percentage to letter grade and store it
                    $letterGrades[] = $this->getGrade($percentage);
                }
            }

            // Store the labels, nilaiValues, skorMaxValues, percentages, and letterGrades in the RumusanMahasiswa object
            $rumusanMahasiswa->labels = $labels;
            $rumusanMahasiswa->nilaiValues = $nilaiValues;
            $rumusanMahasiswa->skorMaxValues = $skorMaxValues;
            $rumusanMahasiswa->percentages = $percentages;
            $rumusanMahasiswa->letterGrades = $letterGrades;
            $rumusanMahasiswa->totalNilai = $totalNilai; // Store total nilai
            $rumusanMahasiswa->totalSkorMax = $totalSkorMax; // Store total skor maks

            // Calculate overall percentage for the RumusanMahasiswa
            $rumusanMahasiswa->overallPercentage = $totalSkorMax > 0 ? ($totalNilai / $totalSkorMax) * 100 : 0;

            // Calculate overall letter grade
            $rumusanMahasiswa->overallGrade = $this->getGrade($rumusanMahasiswa->overallPercentage);
        }

        return view('mahasiswa.show', compact('mahasiswa'));
    }
    public function print($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Initialize an array to hold the labels, nilai, skor_maks, total values, and percentages for each RumusanMahasiswa
        foreach ($mahasiswa->rumusanMahasiswas as $rumusanMahasiswa) {
            $labels = [];
            $nilaiValues = [];
            $skorMaxValues = [];
            $percentages = [];
            $letterGrades = [];

            // Initialize sums
            $totalNilai = 0;
            $totalSkorMax = 0;

            // Loop through the RumusanMahasiswa and extract Cpmk data
            foreach ($rumusanMahasiswa->rumusanDosen->rumusan->rumusanCpls as $rumusanCpl) {
                foreach ($rumusanCpl->rumusanCplCpmks as $rumusanCplCpmk) {
                    $labels[] = $rumusanCplCpmk->cpmk->name; // Assuming you have 'name' field in Cpmk model

                    // Get the nilai from RumusanMahasiswaNilai (which should be pre-populated or edited)
                    $rumusanMahasiswaNilai = $rumusanMahasiswa->rumusanMahasiswaNilais->where('rumusan_cpl_cpmk_id', $rumusanCplCpmk->id)->first();
                    $nilai = $rumusanMahasiswaNilai ? $rumusanMahasiswaNilai->nilai : 0; // Default to 0 if no nilai is found
                    $nilaiValues[] = $nilai;

                    // Get the maximum score (skor_maks)
                    $skorMax = $rumusanCplCpmk->skor_maks;
                    $skorMaxValues[] = $skorMax;

                    // Add to total values
                    $totalNilai += $nilai;
                    $totalSkorMax += $skorMax;

                    // Calculate the percentage for this Cpmk and store it
                    $percentage = $skorMax > 0 ? ($nilai / $skorMax) * 100 : 0;
                    $percentages[] = number_format($percentage, 2); // Format to 2 decimal places

                    // Convert percentage to letter grade and store it
                    $letterGrades[] = $this->getGrade($percentage);
                }
            }

            // Store the labels, nilaiValues, skorMaxValues, percentages, and letterGrades in the RumusanMahasiswa object
            $rumusanMahasiswa->labels = $labels;
            $rumusanMahasiswa->nilaiValues = $nilaiValues;
            $rumusanMahasiswa->skorMaxValues = $skorMaxValues;
            $rumusanMahasiswa->percentages = $percentages;
            $rumusanMahasiswa->letterGrades = $letterGrades;
            $rumusanMahasiswa->totalNilai = $totalNilai; // Store total nilai
            $rumusanMahasiswa->totalSkorMax = $totalSkorMax; // Store total skor maks

            // Calculate overall percentage for the RumusanMahasiswa
            $rumusanMahasiswa->overallPercentage = $totalSkorMax > 0 ? ($totalNilai / $totalSkorMax) * 100 : 0;

            // Calculate overall letter grade
            $rumusanMahasiswa->overallGrade = $this->getGrade($rumusanMahasiswa->overallPercentage);
        }

        return view('mahasiswa.print', compact('mahasiswa'));
    }

    // Helper function to convert percentage to letter grade
    private function getGrade($percentage)
    {
        if ($percentage >= 85) {
            return 'A';
        } elseif ($percentage >= 70) {
            return 'B';
        } elseif ($percentage >= 55) {
            return 'C';
        } elseif ($percentage >= 40) {
            return 'D';
        } elseif ($percentage == null) {
            return '';
        } else {
            return 'E';
        }
    }




    // Delete a Mahasiswa and User
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->user->delete(); // Delete associated User
        $mahasiswa->delete(); // Delete Mahasiswa

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa has been deleted successfully!');
    }

    // ! handle unique combination
    public function attachRumusanDosen(Request $request, $mahasiswaId)
    {
        // Validate the input
        $request->validate([
            'rumusan_dosen_id' => 'array',
            'rumusan_dosen_id.*' => 'numeric|exists:rumusan_dosens,id',  // Ensure the IDs are valid
        ]);

        // Find the Mahasiswa by ID
        $mahasiswa = Mahasiswa::findOrFail($mahasiswaId);

        // If no rumusan_dosen_id is provided, delete all associated records
        if (empty($request->rumusan_dosen_id)) {
            // Delete all RumusanMahasiswa records associated with this Mahasiswa
            $mahasiswa->rumusanMahasiswas()->delete();
            return redirect()->route('mahasiswa.show', $mahasiswa->id)
                ->with('success', 'All Rumusan Dosen relationships removed.');
        }

        // Get the current rumusan_dosen_ids already attached to the mahasiswa
        $existingRumusanDosenIds = $mahasiswa->rumusanMahasiswas->pluck('rumusan_dosen_id')->toArray();

        // Get the new rumusan_dosen_ids from the request
        $newRumusanDosenIds = $request->rumusan_dosen_id;

        // Find the IDs to attach (those that are in $newRumusanDosenIds but not in $existingRumusanDosenIds)
        $toAttach = array_diff($newRumusanDosenIds, $existingRumusanDosenIds);

        // Find the IDs to detach (those that are in $existingRumusanDosenIds but not in $newRumusanDosenIds)
        $toDetach = array_diff($existingRumusanDosenIds, $newRumusanDosenIds);

        // Attach new RumusanDosen entries
        foreach ($toAttach as $rumusanDosenId) {
            // Fetch the RumusanDosen using the ID
            $rumusanDosen = RumusanDosen::findOrFail($rumusanDosenId);

            // Create the RumusanMahasiswa record
            $rumusanMahasiswa = RumusanMahasiswa::create([
                'mahasiswa_id' => $mahasiswa->id,
                'rumusan_dosen_id' => $rumusanDosen->id,
            ]);

            // Fetch related rumusan_cpl_cpmk records for the attached rumusan_dosen
            $rumusanCplCpmks = $rumusanDosen->rumusan->rumusanCpls->flatMap(function ($rumusanCpl) {
                return $rumusanCpl->rumusanCplCpmks; // Get all rumusan_cpl_cpmk for each rumusan_cpl
            });

            // Create rumusan_mahasiswa_nilai entries with nilai = 0
            foreach ($rumusanCplCpmks as $rumusanCplCpmk) {
                RumusanMahasiswaNilai::create([
                    'rumusan_mahasiswa_id' => $rumusanMahasiswa->id,
                    'rumusan_cpl_cpmk_id' => $rumusanCplCpmk->id,
                    'nilai' => 0, // Default value for nilai
                ]);
            }
        }

        // Detach RumusanDosen entries
        RumusanMahasiswa::where('mahasiswa_id', $mahasiswa->id)
            ->whereIn('rumusan_dosen_id', $toDetach)
            ->delete();

        // Redirect back with a success message
        return redirect()->route('mahasiswa.show', $mahasiswa->id)
            ->with('success', 'Rumusan Dosen successfully attached or detached.');
    }

    // Show the form to attach Rumusan Dosen
    public function attachRumusanDosenForm($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $rumusanDosens = RumusanDosen::all();  // Fetch all Rumusan Dosen
        return view('mahasiswa.attach_rumusan', compact('mahasiswa', 'rumusanDosens'));
    }

    public function search(Request $request) {
        if($request->has('search')) {
            $mahasiswa = Mahasiswa::where('name','LIKE','%'.$request->search.'%')->paginate(5)->withQueryString();
        } else {
            $mahasiswa = Mahasiswa::paginate(5); 
        }

        return view('mahasiswa.index',[
            'mahasiswas' => $mahasiswa
        ]);
    }


}