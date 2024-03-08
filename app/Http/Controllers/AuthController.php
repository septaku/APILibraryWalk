<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Metode untuk melakukan login
    public function login(Request $request)
    {
        // Validasi data masukan
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cari pengguna dengan username yang diberikan
        $user = User::where('username', $request->username)->first();

        // Periksa apakah pengguna ditemukan dan kata sandinya cocok
        if (!$user && !Hash::check($request->password, $user->password)) {
            // Autentikasi gagal, kembalikan respons error
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Autentikasi berhasil, buat token akses
        $token = $user->createToken('Personal Access Token')->accessToken;

        // Kembalikan respons dengan token akses
        return response()->json(['token' => $token], 200);
    }
    
}
