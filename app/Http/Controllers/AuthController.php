<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        return view('auth.index');
    }

    public function authenticate(Request $request)
    {
        // Validate credentials
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Attempt login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Check if user has the 'Mahasiswa' role
            if (Auth::user()->hasRole('Mahasiswa')) {
                // Get the related Mahasiswa data using the user ID
                $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();

                if ($mahasiswa) {
                    // Redirect the user to their own Mahasiswa data
                    return redirect()->route('mahasiswa.show', $mahasiswa->id);
                }

                // If Mahasiswa data doesn't exist for some reason
                return redirect()->route('mahasiswa.index')->with('error', 'Mahasiswa data not found.');
            }

            // Redirect to the dashboard if not a Mahasiswa
            return redirect()->intended('dashboard');
        }

        // If login fails, return with error message
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }


    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
