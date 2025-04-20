<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048',
        ]);

        $user = auth()->user();

        if (!($user instanceof UserModel)) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan.',
            ], 404);
        }

        if ($user->foto_profil && Storage::disk('public')->exists('profile/' . $user->foto_profil)) {
            Storage::disk('public')->delete('profile/' . $user->foto_profil);
        }

        $filename = uniqid() . '.' . $request->file('photo')->extension();
        $request->file('photo')->storeAs('profile', $filename, 'public');

        try {
            $user->foto_profil = $filename;
            $user->save();
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil diperbarui.',
            'photo_url' => asset('storage/profile/' . $filename),
        ]);
    }
}