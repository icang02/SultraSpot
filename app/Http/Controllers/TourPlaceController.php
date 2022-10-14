<?php

namespace App\Http\Controllers;

use App\Models\TourPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Inertia\Inertia;

class TourPlaceController extends Controller
{
    public function index()
    {
        $this->authorize('admin');

        return view('dashboard.admin.wisata.index', [
            'title' => 'Wisata',
            'wisata_' => TourPlace::all(),
        ]);
    }


    public function listWisata()
    {
        return Inertia::render('Dashboard/Pengunjung/Wisata', [
            'title' => 'Wisata',
            'allWisata' => TourPlace::all(),
        ]);
    }

    public function detailWisata($id)
    {
        return Inertia::render('Dashboard/Pengunjung/DetailWisata', [
            'title' => 'Detail Wisata',
            'wisata' => TourPlace::find($id),
        ]);
    }

    public function carts()
    {
        return view('dashboard.pengunjung.wisata.index', [
            'title' => 'Wisata',
            'wisata_' => TourPlace::all(),
        ]);
    }
}
