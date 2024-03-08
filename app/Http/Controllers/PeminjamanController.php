<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    // Mendapatkan daftar peminjaman
    public function index()
    {
        $peminjamans = Peminjaman::all();
        return response()->json($peminjamans);
    }

    // Mendapatkan informasi peminjaman berdasarkan ID
    public function show($id)
    {
        $peminjaman = Peminjaman::find($id);

        if ($peminjaman) {
            return response()->json([
                'status' => true,
                'message' => 'Informasi peminjaman ditemukan',
                'data' => $peminjaman
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Informasi peminjaman tidak ditemukan'
            ]);
        }
    }

    // Membuat peminjaman baru
    public function store(Request $request)
    {
        try {
            $request->validate([
                'UserID' => 'required|integer',
                'BukuID' => 'required|integer',
                'TanggalPeminjaman' => 'required|date_format:d/m/Y',
                'TanggalPengembalian' => 'required|date_format:d/m/Y',
            ]);

            // Set nilai default untuk StatusPeminjaman jika tidak disertakan dalam request
            $input = $request->all();
            if (!isset($input['StatusPeminjaman'])) {
                $input['StatusPeminjaman'] = 'Belum Di Ambil';
            }

            // Konversi format tanggal
            $tanggalPeminjaman = Carbon::createFromFormat('d/m/Y', $request->TanggalPeminjaman)->format('Y-m-d');
            $tanggalPengembalian = Carbon::createFromFormat('d/m/Y', $request->TanggalPengembalian)->format('Y-m-d');

            // Simpan peminjaman
            $peminjaman = Peminjaman::create([
                'UserID' => $request->UserID,
                'BukuID' => $request->BukuID,
                'TanggalPeminjaman' => $tanggalPeminjaman,
                'TanggalPengembalian' => $tanggalPengembalian,
                'StatusPeminjaman' => $input['StatusPeminjaman'],
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Peminjaman berhasil dibuat',
                'data' => $peminjaman
            ], 201);
        } catch (\Exception $e) {
            // Tangkap dan catat log error
            \Log::error('Error while creating peminjaman: ' . $e->getMessage());

            // Berikan respons error ke klien
            return response()->json([
                'status' => false,
                'message' => 'Gagal membuat peminjaman',
                'error' => $e->getMessage()
            ], 500);
        }
    }




    // Memperbarui informasi peminjaman
    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::find($id);

        if ($peminjaman) {
            $request->validate([
                'UserID' => 'required|integer',
                'BukuID' => 'required|integer',
                'TanggalPeminjaman' => 'required|date_format:d/m/Y',
                'TanggalPengembalian' => 'required|date_format:d/m/Y',
                'StatusPeminjaman' => 'required|in:Belum Di Ambil,Dipinjam,Sudah Dikembalikan',
            ]);
            

            $peminjaman->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Informasi peminjaman berhasil diperbarui',
                'data' => $peminjaman
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Informasi peminjaman tidak ditemukan'
            ]);
        }
    }

    // Menghapus peminjaman
    public function destroy($id)
    {
        $peminjaman = Peminjaman::find($id);

        if ($peminjaman) {
            $peminjaman->delete();
            return response()->json([
                'status' => true,
                'message' => 'Peminjaman berhasil dihapus'
            ], 204);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Informasi peminjaman tidak ditemukan'
            ]);
        }
    }
}
