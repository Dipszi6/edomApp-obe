<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DosenDashboardController extends Controller
{
    public function index()
    {
        $dosen = Auth::user()->dosen;

        if (!$dosen) {
            abort(403, 'Profil dosen tidak ditemukan.');
        }

        $reviews = $dosen->reviews()
            ->where('is_visible', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.dosen', compact('dosen', 'reviews'));
    }
}