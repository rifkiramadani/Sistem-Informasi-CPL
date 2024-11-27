<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mata_kuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    public function index() {
        return view('dosen.index',[
            "dosens" => Dosen::all(),
            "matakuliahs" => Mata_kuliah::all(),
        ]);
    }
    
    public function create() {
        return view('dosen.create');
    }

    public function store(Request $request) {
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

    public function edit($id) {
        return view('dosen.edit', [
            'dosen' => Dosen::find($id),
        ]);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required',
            // 'user_id' => 'required',
            'user_id' => 'numeric',
            'nip' => 'required'
        ]);

        $dosen = Dosen::findOrFail($id);
        $user = User::findOrFail($dosen->user_id);

        $path = $user->profile_picture; // Simpan path lama jika tidak diupdate
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
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

        return redirect('/dosen')->with('success','Data Dosen Berhasil Di Ubah');
    }

    public function destroy($id) {
        $dosen = Dosen::findOrFail($id);
        $user = User::findOrFail($dosen->user_id);

        $dosen->delete();
        $user->delete();

        return redirect('/dosen')->with('success', 'Data Dosen Berhasil Di Hapus');
    }

    public function addMatakuliah($id) {
        return view('dosen.addMatakuliah',[
            'dosen' => Dosen::find($id),
            'matakuliahs' => Mata_kuliah::all(), 
        ]);
    }

    public function insertMatakuliah(Request $request, $id) {
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

}