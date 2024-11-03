<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mata_kuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            'password' => 'required',
            // 'user_id' => 'required',
            'user_id' => 'numeric',
            'nip' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
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

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password ?? $user->password),
        ]);

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

        $dosen->matakuliah()->sync($request->mata_kuliah_id ?? []);

        return redirect('/dosen')->with('success', 'Set Mata Kuliah Berhasil');
    }

}