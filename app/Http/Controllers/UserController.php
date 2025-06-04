<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UpdateUserFieldRequest;

class UserController extends Controller
{
    public function updateField(Request $request)
    {
        $user = Auth::user(); // ambil user yang login
        if (!$user instanceof \App\Models\User) {
            $user = User::find($user->id);
        }
        // Pastikan $user adalah instance dari User model
        if (!$user instanceof \App\Models\User) {
            return back()->with('error', 'User tidak ditemukan.');
        }

        $request->validate([
            'field' => 'required|string',
            'value' => 'nullable|string',
        ]);

        // daftar field yang boleh diubah
        $allowedFields = ['name', 'birthdate', 'gender', 'address', 'email', 'phone'];

        if (!in_array($request->field, $allowedFields)) {
            return back()->with('error', 'Field tidak valid.');
        }

        // update field
        $user->{$request->field} = $request->value;
        $user->save();

        return back()->with('success', 'Data berhasil diperbarui.');
    }
}