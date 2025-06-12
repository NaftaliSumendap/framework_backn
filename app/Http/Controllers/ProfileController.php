<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function updateAjax(Request $request)
    {
        $user = Auth::user();
        if ($request->field === 'address') {
            $user->address = $request->value;
            $user->save();
            return response()->json(['success' => true, 'message' => 'Alamat berhasil diperbarui!']);
        }
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

    public function updatePhoto(Request $request)
{
    $request->validate([
        'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = Auth::user();
    $file = $request->file('photo');
    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('img'), $filename);

    // Hapus foto lama jika ada
    if ($user->image && file_exists(public_path('img/' . $user->image))) {
        @unlink(public_path('img/' . $user->image));
    }

    $user->image = $filename;
    $user->save();

    return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
}


}