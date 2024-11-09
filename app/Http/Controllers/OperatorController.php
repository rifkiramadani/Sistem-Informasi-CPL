<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operator;
use App\Models\User;

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
            'nip' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

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

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
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
