<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        // Jika ada password baru, maka lakukan hashing
        if ($request->password && $request->password !== $user->password) {
            $user->password = bcrypt($request->password);
        }

        // Simpan perubahan
        $user->save();

        return redirect('/profile')->with('success', 'Data Profile Berhasil Di Ubah');

    }
}
