<?php

namespace App\Http\Controllers;

use App\Models\TourPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Inertia\Inertia;

class TourPlaceController extends Controller
{
    public function listWisata()
    {
        if (auth()->user()->role_id == 1) {
            $toRender = 'Dashboard/Admin/Wisata';
        } else if (auth()->user()->role_id == 2) {
            $toRender = 'Dashboard/Pengunjung/Wisata';
        }

        return Inertia::render($toRender, [
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
