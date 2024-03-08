<?php

namespace App\Http\Controllers;

use App\Models\KategoriBukuRelasi;
use Illuminate\Http\Request;

class KategoriBukuRelasiController extends Controller
{
    // Mendapatkan daftar relasi kategori buku
    public function index()
    {
        $relasis = KategoriBukuRelasi::all();
        return response()->json($relasis);
    }

    // Mendapatkan informasi relasi kategori buku berdasarkan ID
    public function show($id)
    {
        $relasi = KategoriBukuRelasi::find($id);

        if ($relasi) {
            return response()->json([
                'status' => true,
                'message' => 'Informasi relasi kategori buku ditemukan',
                'data' => $relasi
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Informasi relasi kategori buku tidak ditemukan'
            ]);
        }
    }

    // Membuat relasi kategori buku baru
    public function store(Request $request)
    {
        $request->validate([
            'BukuID' => 'required|integer',
            'KategoriID' => 'required|integer',
        ]);

        $relasi = KategoriBukuRelasi::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Relasi kategori buku berhasil ditambahkan',
            'data' => $relasi
        ], 201);
    }

    // Memperbarui informasi relasi kategori buku
    public function update(Request $request, $id)
    {
        $relasi = KategoriBukuRelasi::find($id);

        if ($relasi) {
            $request->validate([
                'BukuID' => 'required|integer',
                'KategoriID' => 'required|integer',
            ]);

            $relasi->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Informasi relasi kategori buku berhasil diperbarui',
                'data' => $relasi
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Informasi relasi kategori buku tidak ditemukan'
            ]);
        }
    }

    // Menghapus relasi kategori buku
    public function destroy($id)
    {
        $relasi = KategoriBukuRelasi::find($id);

        if ($relasi) {
            $relasi->delete();
            return response()->json([
                'status' => true,
                'message' => 'Relasi kategori buku berhasil dihapus'
            ], 204);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Informasi relasi kategori buku tidak ditemukan'
            ]);
        }
    }
}
