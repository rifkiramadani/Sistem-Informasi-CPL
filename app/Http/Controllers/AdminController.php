<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index', [
            'admins' => Admin::with('user')->paginate(10)
        ]);
    }

    public function create() {
        return view('admin.create');
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
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
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

        Admin::create([
            'user_id' => $user->id,
            'nip' => $request->nip
        ]);

        $user->assignRole('Admin');

        return redirect('/admin')->with('success', 'Data Dosen Berhasil Di Tambah');
    }

    public function edit($id) {
        return view('admin.edit', [
            'admin' => Admin::find($id),
        ]);
    }

    public function update(Request $request, $id) {
        $admin = Admin::findOrFail($id);
        $user = User::findOrFail($admin->user_id);

        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email:dns',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'password' => 'required',
            // 'user_id' => 'required',
            'user_id' => 'numeric',
            'nip' => 'required',
        ]);

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

        $admin->update([
            'nip' => $request->nip
        ]);

        return redirect('/admin')->with('success', 'Data Admin Berhasil Di Ubah');
    }

    public function destroy($id) {
        $admin = Admin::findOrFail($id);
        $user = User::findOrFail($admin->user_id);

        $admin->delete();
        $user->delete();

        return redirect('/admin')->with('success', 'Data Admin Berhasil Di Hapus');

    }
}
