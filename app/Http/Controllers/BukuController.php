<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // Mendapatkan daftar buku
    public function index()
    {
        $bukus = Buku::all();
        return response()->json($bukus);
    }

    // Mendapatkan informasi buku berdasarkan ID
    public function show($id)
    {
        $buku = Buku::find($id);
        if ($buku) {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $buku
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
        
    }

    // Membuat buku baru
    public function store(Request $request)
    {
        // Lakukan validasi input di sini
        $request->validate([
            'Judul' => 'required|string',
            'Penulis' => 'required|string',
            'Penerbit' => 'required|string',
            'TahunTerbit' => 'required|integer',
            'cover_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto sampul
        ]);

        // Simpan foto sampul
        $path = $request->file('cover_photo')->store('covers'); // Simpan di direktori 'storage/app/covers'

        // Buat buku baru dengan path foto sampul
        $buku = Buku::create(array_merge($request->except('cover_photo'), ['cover_photo' => $path]));

        return response()->json([
            'status' => true,
            'message' => 'Buku berhasil ditambahkan',
            'data' => $buku
        ], 201);
    }

   // Memperbarui informasi buku
public function update(Request $request, $id)
{
    try {
        $buku = Buku::find($id);

        // Lakukan validasi input di sini
        $validatedData = $request->validate([
            'Judul' => 'nullable|string',
            'Penulis' => 'nullable|string',
            'Penerbit' => 'nullable|string',
            'TahunTerbit' => 'nullable|integer',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto sampul (opsional)
        ]);

        // Gunakan metode fill untuk mengisi atribut yang diperbarui
        $buku->fill($request->all());

        // Jika ada foto sampul yang diunggah, perbarui path foto sampul
        if ($request->hasFile('cover_photo')) {
            // Validasi dan simpan foto sampul
            $path = $request->file('cover_photo')->store('covers');
            $buku->cover_photo = $path;
        }

        // Simpan perubahan
        $buku->save();

        return response()->json([
            'status' => true,
            'message' => 'Data buku berhasil diperbarui',
            'data' => $buku
        ]);
    } catch (\Exception $e) {
        // Tangkap dan catat log error
        \Log::error('Error while updating book: ' . $e->getMessage());

        // Berikan respons error ke klien
        return response()->json([
            'status' => false,
            'message' => 'Gagal memperbarui informasi buku',
            'error' => $e->getMessage()
        ], 500); // Internal Server Error
    }
}



    
    // Menghapus buku
    public function destroy($id)
    {
        $buku = Buku::find($id);
        if ($buku) {
            $buku->delete();
            return response()->json([
                'status' => true,
                'message' => 'Buku berhasil dihapus'
            ], 204);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404); // 404 Not Found
        }
    }
}