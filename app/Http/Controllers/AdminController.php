<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index', [
            'admins' => Admin::all()
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
            'nip' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
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
            'admin' => Admin::find($id)
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

        $admin = Admin::findOrFail($id);
        $user = User::findOrFail($admin->user_id);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password ?? $user->password),
        ]);

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
