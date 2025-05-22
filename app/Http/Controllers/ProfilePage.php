<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; 

use App\Models\User;

class ProfilePage extends Controller
{
    public function data()
    {
        $user = auth()->user();
        $profile = $user->profile;

        return response()->json([
            'nama' => $user->name,
            'ttl' => $profile && $profile->birthplace && $profile->birthdate
                ? ($profile->birthplace . ', ' . $profile->birthdate->format('d M Y'))
                : '-',
            'gender' => $profile && $profile->gender
                ? ($profile->gender === 'male' ? 'Laki-laki' : 'Perempuan')
                : '-',
            'nip' => $profile->nip ?? '-',
            'email' => $user->email,
            'alamat' => $profile->address ?? '-',
            'photo_url' => $profile && $profile->photos && count($profile->photos)
                ? Storage::url($profile->photos[0])
                : asset('img/profile/default-profile.png'),
        ]);

    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'ttl' => 'nullable|string',
            'gender' => 'nullable|string',
            'nip' => 'nullable|string',
            'alamat' => 'nullable|string',
        ]);

        $user = auth()->user();
        $user->update([
            'name' => $request->nama,
        ]);

        $profile = $user->profile;
        if ($profile) {
            $ttlParts = explode(',', $request->ttl);
            $profile->update([
                'birthplace' => $ttlParts[0] ?? null,
                'birthdate' => isset($ttlParts[1]) ? trim($ttlParts[1]) : null,
                'gender' => $request->gender,
                'nip' => $request->nip,
                'address' => $request->alamat,
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function updatedPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048',
        ]);

        $user = auth()->user();
        $profile = $user->profile;

        if (!$profile) {
            return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan.']);
        }

        if (!$request->hasFile('photo')) {
            return response()->json(['success' => false, 'message' => 'File foto tidak ditemukan pada request.']);
        }

        $file = $request->file('photo');

        if (!$file->isValid()) {
            return response()->json(['success' => false, 'message' => 'File foto tidak valid.']);
        }

        // Hapus foto lama jika ada
        if ($profile->photos && count($profile->photos)) {
            foreach ($profile->photos as $oldPath) {
                \Storage::disk('public')->delete($oldPath);
            }
        }

        $newPath = $file->store('profile_photos', 'public');

        if (!$newPath) {
            return response()->json([
                'success' => false,
                'path' => null,
                'message' => 'Gagal menyimpan file.'
            ]);
        }

        $profile->photos = [$newPath];
        $saved = $profile->save();

        return response()->json([
            'success' => $saved,
            'path' => $saved ? \Storage::url($newPath) : null,
            'message' => $saved ? null : 'Gagal menyimpan path foto ke database.'
        ]);
    }


}
