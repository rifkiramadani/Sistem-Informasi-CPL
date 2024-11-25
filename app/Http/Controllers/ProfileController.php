<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit() {
        return view('profile.edit',[
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request) {

        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email:dns',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'password' => 'required|string|max:255'
        ]);

          // Jika ada file foto yang diupload
          if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            if ($user->profile_picture && Storage::exists($user->profile_picture)) {
                Storage::delete($user->profile_picture);
            }

            // Simpan foto baru
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect('/profile')->with('success', 'Data Profile Berhasil Di Ubah');

    }
}
