<?php

namespace App\Http\Controllers;

use App\Models\UlasanBuku;
use App\Models\User;
use App\Models\Buku;
use Illuminate\Http\Request;

class UlasanBukuController extends Controller
{
    // Mendapatkan daftar ulasan buku
    public function index()
    {
        $ulasans = UlasanBuku::all();
        return response()->json($ulasans);
    }

    // Mendapatkan informasi ulasan buku berdasarkan ID
    public function show($id)
    {
        $ulasan = UlasanBuku::find($id);

        if ($ulasan) {
            return response()->json([
                'status' => true,
                'message' => 'Data ulasan buku ditemukan',
                'data' => $ulasan
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data ulasan buku tidak ditemukan'
            ]);
        }
    }

    // Membuat ulasan buku baru
    public function store(Request $request)
    {
        $request->validate([
            'UserID' => 'required|integer',
            'BukuID' => 'required|integer',
            'Ulasan' => 'required|string',
            'Rating' => 'required|integer',
        ]);

        $ulasan = UlasanBuku::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Ulasan buku berhasil ditambahkan',
            'data' => $ulasan
        ], 201);
    }

    // Memperbarui informasi ulasan buku
    public function update(Request $request, $id)
    {
        $ulasan = UlasanBuku::find($id);

        if ($ulasan) {
            $request->validate([
                'UserID' => 'required|integer',
                'BukuID' => 'required|integer',
                'Ulasan' => 'required|string',
                'Rating' => 'required|integer',
            ]);

            $ulasan->update($request->all());
            
            return response()->json([
                'status' => true,
                'message' => 'Data ulasan buku berhasil diperbarui',
                'data' => $ulasan
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data ulasan buku tidak ditemukan'
            ]);
        }
    }

    // Menghapus ulasan buku
    public function destroy($id)
    {
        $ulasan = UlasanBuku::find($id);

        if ($ulasan) {
            $ulasan->delete();
            return response()->json([
                'status' => true,
                'message' => 'Ulasan buku berhasil dihapus'
            ], 204);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data ulasan buku tidak ditemukan'
            ]);
        }
    }

    // Relasi dengan tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID')->onDelete('cascade');
    }

    // Relasi dengan tabel buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'BukuID');
    }
}
