<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Mendapatkan daftar pengguna
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Mendapatkan informasi pengguna berdasarkan ID
    public function show($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'Data pengguna ditemukan',
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data pengguna tidak ditemukan'
            ]);
        }
    }

    // Membuat pengguna baru
    public function store(Request $request)
    {
        if (!$request->filled('Role')) {
            // Jika tidak ada, tambahkan 'Role' dengan nilai default 'User'
            $request->merge(['Role' => 'User']);
        }
        // Validasi input
        $request->validate([
            'Username' => 'required|string|unique:users',
            'Password' => 'required|string|min:6',
            'Email' => 'required|email|unique:users',
            'NamaLengkap' => 'required|string',
            'Alamat' => 'required|string',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto profil
            'Role' => 'required|string|in:Admin,Petugas,User',
        ]);

        // Simpan foto profil
        $path = $request->file('profile_picture')->store('profiles'); // Simpan di direktori 'storage/app/profiles'

        // Hash password
        $password = Hash::make($request->Password);

        // Tentukan peran (role) pengguna
        $role = $request->input('Role', 'User');

        // Simpan pengguna baru
        try {
            $user = new User();
            $user->Username = $request->Username;
            $user->Password = $password;
            $user->Email = $request->Email;
            $user->NamaLengkap = $request->NamaLengkap;
            $user->Alamat = $request->Alamat;
            $user->profile_picture = $path; // Simpan path foto profil ke dalam tabel
            $user->Role = $role; // Simpan peran (role) pengguna
            $user->save();


            // Berhasil, kembalikan respons
            return response()->json([
                'status' => true,
                'message' => 'Pengguna berhasil dibuat',
                'data' => $user
            ], 201);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return response()->json([
                'status' => false,
                'message' => 'Gagal membuat pengguna',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Memperbarui informasi pengguna
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        // Lakukan validasi input di sini
        $request->validate([
            'Username' => 'nullable|string|unique:users,Username,' . $id . ',UserID',
            'Password' => 'nullable|string|min:6',
            'Email' => 'nullable|email|unique:users,Email,' . $id . ',UserID',
            'NamaLengkap' => 'nullable|string',
            'Alamat' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto profil (opsional)
            'Role' => 'string|in:Admin,Petugas,User',
        ]);

        // Gunakan metode fill untuk mengisi atribut yang diperbarui
        $user->fill($request->all());

        
        // Jika ada perubahan password, maka hash password baru
        if ($request->has('Password')) {
            $user->Password = Hash::make($request->Password);
        }

        // Jika ada foto profil baru diunggah, simpan foto tersebut
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profiles'); // Simpan di direktori 'storage/app/profiles'
            $user->profile_picture = $path;
        }

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Data pengguna berhasil diperbarui',
            'data' => $user
        ]);
    }


    // Menghapus pengguna
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return response()->json([
                'status' => true,
                'message' => 'Pengguna berhasil dihapus'
            ], 204);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data pengguna tidak ditemukan'
            ]);
        }
    }
}
