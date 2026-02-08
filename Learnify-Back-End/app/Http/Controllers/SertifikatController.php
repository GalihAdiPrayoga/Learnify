<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use Illuminate\Support\Facades\Auth;

class SertifikatController extends Controller
{
    /**
     * GET /user/sertifikat - List current user's certificates
     */
    public function index()
    {
        $sertifikats = Sertifikat::with('kelas')
            ->where('user_id', Auth::id())
            ->orderBy('tanggal_terbit', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $sertifikats
        ]);
    }

    /**
     * GET /user/sertifikat/{id} - View certificate detail
     */
    public function show($id)
    {
        $sertifikat = Sertifikat::with(['kelas', 'user'])->find($id);

        if (!$sertifikat || $sertifikat->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Sertifikat tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $sertifikat
        ]);
    }

    /**
     * GET /admin/sertifikat - List all certificates (admin)
     */
    public function adminIndex()
    {
        $sertifikats = Sertifikat::with(['user', 'kelas'])
            ->orderBy('tanggal_terbit', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $sertifikats
        ]);
    }
}
