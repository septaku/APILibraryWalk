<?php

namespace App\Http\Controllers;

use App\Models\KoleksiPribadi;
use Illuminate\Http\Request;

class KoleksiPribadiController extends Controller
{
    // Mendapatkan daftar koleksi pribadi
    public function index()
    {
        $koleksiPribadis = KoleksiPribadi::all();
        return response()->json($koleksiPribadis);
    }

    // Mendapatkan informasi koleksi pribadi berdasarkan ID
    public function show($id)
    {
        $koleksiPribadi = KoleksiPribadi::find($id);

        if ($koleksiPribadi) {
            return response()->json([
                'status' => true,
                'message' => 'Informasi koleksi pribadi ditemukan',
                'data' => $koleksiPribadi
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Informasi koleksi pribadi tidak ditemukan'
            ]);
        }
    }

    // Membuat koleksi pribadi baru
    public function store(Request $request)
    {
        $request->validate([
            'UserID' => 'required|integer',
            'BukuID' => 'required|integer',
        ]);

        $koleksiPribadi = KoleksiPribadi::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Koleksi pribadi berhasil ditambahkan',
            'data' => $koleksiPribadi
        ], 201);
    }

    // Memperbarui informasi koleksi pribadi
    public function update(Request $request, $id)
    {
        $koleksiPribadi = KoleksiPribadi::find($id);

        if ($koleksiPribadi) {
            $request->validate([
                'UserID' => 'required|integer',
                'BukuID' => 'required|integer',
            ]);

            $koleksiPribadi->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Informasi koleksi pribadi berhasil diperbarui',
                'data' => $koleksiPribadi
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Informasi koleksi pribadi tidak ditemukan'
            ]);
        }
    }

    // Menghapus koleksi pribadi
    public function destroy($id)
    {
        $koleksiPribadi = KoleksiPribadi::find($id);

        if ($koleksiPribadi) {
            $koleksiPribadi->delete();
            return response()->json([
                'status' => true,
                'message' => 'Koleksi pribadi berhasil dihapus'
            ], 204);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Informasi koleksi pribadi tidak ditemukan'
            ]);
        }
    }
}
