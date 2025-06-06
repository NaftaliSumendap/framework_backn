<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log; // BARIS INI DITAMBAHKAN

class UserController extends Controller
{
    /**
     * Memperbarui field profil pengguna melalui AJAX.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateField(Request $request)
    {
        $user = Auth::user(); // ambil user yang login

        // Pastikan $user adalah instance dari User model dan ada
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan atau belum login.'
            ], 401); // HTTP 401 Unauthorized
        }

        // Validasi input menggunakan Validator facade
        $validator = Validator::make($request->all(), [
            'field' => 'required|string',
            'value' => 'nullable|string|max:255', // Tambahkan max length untuk keamanan
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422); // HTTP 422 Unprocessable Entity
        }

        $field = $request->field;
        $value = $request->value;

        // daftar field yang boleh diubah
        $allowedFields = ['name', 'birthdate', 'gender', 'address', 'email', 'phone'];

        if (!in_array($field, $allowedFields)) {
            return response()->json([
                'success' => false,
                'message' => 'Field tidak valid.'
            ], 400); // HTTP 400 Bad Request
        }

        // Khusus untuk email, tambahkan validasi email unik
        if ($field === 'email') {
            $emailValidator = Validator::make($request->all(), [
                'value' => 'required|email|unique:users,email,' . $user->id,
            ]);

            if ($emailValidator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email sudah digunakan atau tidak valid.',
                    'errors' => $emailValidator->errors()
                ], 422);
            }
        }

        try {
            // update field
            $user->{$field} = $value;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => ucfirst($field) . ' berhasil diperbarui.',
                'user' => $user->fresh() // Opsional: kirim kembali data user yang sudah diperbarui
            ]);

        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Gagal memperbarui field user (' . $field . '): ' . $e->getMessage()); // Menggunakan Log facade
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server saat memperbarui ' . $field . '.'
            ], 500); // HTTP 500 Internal Server Error
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role; // pastikan ini sesuai dengan field yang ada di model User

        $user->save();

        return redirect()->back()->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }

    public function store(Request $request)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'role' => 'required|string',
        'password' => 'required|string|min:6',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = $file->getClientOriginalName(); // hanya nama file
        $file->storeAs('users', $filename, 'public'); // simpan file ke storage/app/public/users
        $validated['image'] = $filename; // hanya nama file yang disimpan ke DB
    }

    $validated['password'] = bcrypt($validated['password']);

    User::create($validated);

    return redirect()->back()->with('success', 'User berhasil ditambahkan.');
    }
}
