<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Operator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class OperatorController extends Controller
{
    public function index() {
        return view('operator.index', [
            'operators' => Operator::all()
        ]);
    }

    public function create() {
        return view('operator.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required',
            // 'user_id' => 'required',
            'user_id' => 'numeric',
            'nip' => 'required',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $path = null;
        if ($request->hasFile('profile_picture')) {
            // Simpan foto ke dalam folder public/profile_pictures
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
        
        Operator::create([
            'user_id' => $user->id,
            'nip' => $request->nip,
        ]);

        $user->assignRole('Operator');

        return redirect('/operator')->with('success', 'Data Operator Berhasil Di Tambah');
    }

    public function edit($id) {
        return view('operator.edit', [
            'operator' => Operator::findOrFail($id),
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

        $operator = Operator::findOrFail($id);
        $user = User::findOrFail($operator->user_id);

        $path = $user->profile_picture; // Simpan path lama jika tidak diupdate
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'profile_picture' => $path,
            'password' => bcrypt($request->password ?? $user->password),
        ]);

        $operator->update([
            'nip' => $request->nip
        ]);

        return redirect('/operator')->with('success', 'Data Operator Berhasil Di Ubah');
    }

    public function destroy($id) {
        $operator = Operator::findOrFail($id);
        $user = User::findOrFail($operator->user_id);

        $operator->delete();
        $user->delete();

        return redirect('/operator')->with('success', 'Data Operator Berhasil Di Hapus');
    }
}
