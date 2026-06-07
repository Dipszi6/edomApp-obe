<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Matkul;

class HomeController extends Controller
{
    public function index()
    {
        $topDosens = Dosen::orderBy('avg_rating', 'desc')->take(5)->get();
        $topMatkuls = Matkul::orderBy('avg_rating', 'desc')->take(5)->get();

        return view('home', compact('topDosens', 'topMatkuls'));
    }
}