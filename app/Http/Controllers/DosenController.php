<?php

namespace App\Http\Controllers;

use App\Models\Rumusan;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mata_kuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    public function index()
    {
        return view('dosen.index', [
            "dosens" => Dosen::with('user')->paginate(5),
            "matakuliahs" => Mata_kuliah::all(),
        ]);
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email:dns',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'password' => 'required',
            // 'user_id' => 'required',
            'user_id' => 'numeric',
            'nip' => 'required'
        ]);

        $path = null;
        if ($request->hasFile('profile_picture')) {
            // Simpan foto ke dalam folder public/profile_pictures
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'profile_picture' => $path,
            'password' => bcrypt($request->password),
        ]);


        Dosen::create([
            'user_id' => $user->id,
            'nip' => $request->nip
        ]);

        $user->assignRole('Dosen');

        return redirect('/dosen')->with('success', 'Data Dosen Berhasil Di Tambah');

    }

    public function edit($id)
    {
        return view('dosen.edit', [
            'dosen' => Dosen::find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            // 'user_id' => 'required',
            'user_id' => 'numeric',
            'nip' => 'required'
        ]);

        $dosen = Dosen::findOrFail($id);
        $user = User::findOrFail($dosen->user_id);

        $path = $user->profile_picture;
        if ($request->hasFile('profile_picture')) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path; // Simpan path baru ke database
        }


        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        // Jika ada password baru, maka lakukan hashing
        if ($request->password && $request->password !== $user->password) {
            $user->password = bcrypt($request->password);
        }

        // Simpan perubahan
        $user->save();

        $dosen->update([
            'nip' => $request->nip
        ]);

        return redirect('/dosen')->with('success', 'Data Dosen Berhasil Di Ubah');
    }

    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $user = User::findOrFail($dosen->user_id);

        $dosen->delete();
        $user->delete();

        return redirect('/dosen')->with('success', 'Data Dosen Berhasil Di Hapus');
    }

    public function addMatakuliah($id)
    {
        return view('dosen.addMatakuliah', [
            'dosen' => Dosen::find($id),
            'matakuliahs' => Mata_kuliah::all(),
        ]);
    }

    public function insertMatakuliah(Request $request, $id)
    {
        // dd($request->all());

        $validated = $request->validate([
            "mata_kuliah_id" => 'required|array',
            "mata_kuliah_id.*" => 'numeric'
        ]);

        $dosen = Dosen::findOrFail($id);

        // Cek apakah 'Tidak Ada' dicentang, jika ya, kosongkan mata kuliah
        if ($request->has('no_subject')) {
            $dosen->matakuliah()->sync([]); // Menghapus semua mata kuliah dari dosen
        } else {
            $dosen->matakuliah()->sync($request->mata_kuliah_id ?? []);
        }

        return redirect('/dosen')->with('success', 'Set Mata Kuliah Berhasil');
    }

    public function attachRumusan($id)
    {
        $dosen = Dosen::findOrFail($id);
        $rumusans = Rumusan::all();  // Fetch all Rumusans

        return view('dosen.attachRumusan', compact('dosen', 'rumusans'));
    }

    public function insertRumusan(Request $request, $id)
    {
        $validated = $request->validate([
            "rumusan_id" => 'array',
            "rumusan_id.*" => 'numeric'
        ]);

        $dosen = Dosen::findOrFail($id);  // Find Dosen by ID

        // If no rumusan_id is provided, delete all associated records
        if (empty($request->rumusan_id)) {
            // Delete all RumusanDosen entries associated with this Dosen
            $dosen->rumusanDosens()->delete();
            return redirect('/dosen')->with('success', 'All Rumusan relationships removed.');
        }

        // Get the current rumusan_ids already attached to the dosen
        $existingRumusanIds = $dosen->rumusanDosens->pluck('rumusan_id')->toArray();

        // Get the new rumusan_ids from the request
        $newRumusanIds = $request->rumusan_id;

        // Find the IDs to attach (those that are in $newRumusanIds but not in $existingRumusanIds)
        $toAttach = array_diff($newRumusanIds, $existingRumusanIds);

        // Find the IDs to detach (those that are in $existingRumusanIds but not in $newRumusanIds)
        $toDetach = array_diff($existingRumusanIds, $newRumusanIds);

        // Attach new RumusanDosen entries
        foreach ($toAttach as $rumusanId) {
            $dosen->rumusanDosens()->create([
                'rumusan_id' => $rumusanId,  // Attach rumusan to dosen
            ]);
        }

        // Detach RumusanDosen entries
        $dosen->rumusanDosens()->whereIn('rumusan_id', $toDetach)->delete();

        return redirect('/dosen')->with('success', 'Rumusan Successfully Attached or Detached');
    }




}