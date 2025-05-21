<?php

namespace App\Livewire;

use Livewire\Component;

class ProfilePage extends Component
{
    public function data()
    {
        $user = auth()->user();

        return response()->json([
            // 'nama' => $user->nama,
            // 'ttl' => $user->tempat_lahir . ', ' . $user->tanggal_lahir,
            // 'gender' => $user->jenis_kelamin,
            // 'nip' => $user->nip,
            // 'username' => $user->username,
            // 'email' => $user->email,
            // 'alamat' => $user->alamat,

            // data contoh
            'nama' => 'Andi Saputra',
            'ttl' => 'Jakarta, 15 Maret 1998',
            'gender' => 'Laki-laki',
            'nip' => '198103150001',
            'username' => 'andis',
            'email' => 'andi@example.com',
            'alamat' => 'Jl. Merdeka No.1, Jakarta',
        ]);
    }
}
