<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function updateAjax(Request $request)
    {
        $user = Auth::user();
        $field = $request->input('field');
        $value = $request->input('value');

        // Mapping field dari spanId ke kolom database
        $fieldMap = [
            'nama' => 'name',
            'tanggal_lahir' => 'birth_date',
            'jenis_kelamin' => 'gender',
            'alamat' => 'address',
            'email' => 'email',
            'nomor_hp' => 'phone',
        ];

        $dbField = $fieldMap[$field] ?? null;
        if ($dbField && $user) {
            $user->$dbField = $value;
            $user->save();
            return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui!', 'value' => $value]);
        }
        return response()->json(['success' => false, 'message' => 'Gagal memperbarui profil.']);
    }
}