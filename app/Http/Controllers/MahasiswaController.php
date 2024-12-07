<?php

namespace App\Http\Controllers;

use App\Models\RumusanDosen;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class MahasiswaController extends Controller
{
    // Show the list of Mahasiswa
    public function index()
    {
        return view('mahasiswa.index', [
            'mahasiswas' => Mahasiswa::all(),
        ]);
    }

    // Show the form to create a new Mahasiswa
    public function create()
    {
        $semesters = Semester::all();
        return view('mahasiswa.create', compact('semesters'));
    }

    // Store a new Mahasiswa and User
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|unique:mahasiswas,npm',
            'semester_id' => 'required|exists:semesters,id',
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
            'semester_id' => $request->semester_id,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa has been created successfully!');
    }

    // Show the form to edit an existing Mahasiswa
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $semesters = Semester::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'semesters'));
    }

    // Update an existing Mahasiswa and User
    public function update(Request $request, $id)
    {
        $request->validate([
            'npm' => 'required|unique:mahasiswas,npm,' . $id,
            'name' => 'required|string|max:255',
            'semester_id' => 'required|exists:semesters,id',
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
            'email' => $username . '@anjas.com',  // Sync email with username
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
            'semester_id' => $request->semester_id,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa successfully updated.');
    }

    // Show the details of a specific Mahasiswa
    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    // Delete a Mahasiswa and User
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->user->delete(); // Delete associated User
        $mahasiswa->delete(); // Delete Mahasiswa

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa has been deleted successfully!');
    }

    public function attachRumusanDosen(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'rumusan_dosen_id' => 'required|exists:rumusan_dosens,id',
        ]);

        // Find the Mahasiswa
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Attach the RumusanDosen to Mahasiswa via the RumusanMahasiswa model
        $mahasiswa->rumusanMahasiswas()->create([
            'rumusan_dosen_id' => $request->rumusan_dosen_id,
        ]);

        return redirect()->route('mahasiswa.show', $id)->with('success', 'Rumusan Dosen has been successfully attached!');
    }

    // Show the form to attach Rumusan Dosen
    public function attachRumusanDosenForm($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $rumusanDosens = RumusanDosen::all();
        return view('mahasiswa.attach_rumusan', compact('mahasiswa', 'rumusanDosens'));
    }

}