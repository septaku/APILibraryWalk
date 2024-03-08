<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class KategoriBukuController extends Controller
{
    // Mendapatkan daftar kategori buku
    public function index()
    {
        $kategoris = KategoriBuku::all();
        return response()->json($kategoris);
    }

    // Mendapatkan informasi kategori buku berdasarkan ID
    public function show($id)
    {
        $kategori = KategoriBuku::find($id);

        if ($kategori) {
            return response()->json([
                'status' => true,
                'message' => 'Informasi kategori buku ditemukan',
                'data' => $kategori
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Informasi kategori buku tidak ditemukan'
            ]);
        }
    }

    // Membuat kategori buku baru
    public function store(Request $request)
    {
        $request->validate([
            'NamaKategori' => 'required|string',
        ]);

        $kategori = KategoriBuku::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Kategori buku berhasil ditambahkan',
            'data' => $kategori
        ], 201);
    }

    // Memperbarui informasi kategori buku
    public function update(Request $request, $id)
    {
        $kategori = KategoriBuku::find($id);

        if ($kategori) {
            $request->validate([
                'NamaKategori' => 'required|string',
            ]);

            $kategori->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Informasi kategori buku berhasil diperbarui',
                'data' => $kategori
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Informasi kategori buku tidak ditemukan'
            ]);
        }
    }

    // Menghapus kategori buku
    public function destroy($id)
    {
        $kategori = KategoriBuku::find($id);

        if ($kategori) {
            $kategori->delete();
            return response()->json([
                'status' => true,
                'message' => 'Kategori buku berhasil dihapus'
            ], 204);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Informasi kategori buku tidak ditemukan'
            ]);
        }
    }
}
