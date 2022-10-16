<?php

namespace App\Http\Controllers;

use App\Models\TourPlace;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class TourPlaceController extends Controller
{
    public function listWisata()
    {
        $wisata = TourPlace::all();

        if (auth()->user()->role_id == 1) {
            $toRender = 'Dashboard/Admin/Wisata';
        } else if (auth()->user()->role_id == 2) {
            $toRender = 'Dashboard/Pengunjung/Wisata';
        } else if (auth()->user()->role_id == 3) {
            $toRender = 'Dashboard/Pengelola/Wisata';
            $wisata = TourPlace::where('id', auth()->user()->id)->get()->first();
        }

        return Inertia::render($toRender, [
            'title' => 'Wisata',
            'allWisata' => $wisata,
        ]);
    }

    public function detailWisata($id)
    {
        // dd($id);
        return Inertia::render('Dashboard/Pengunjung/DetailWisata', [
            'title' => 'Detail Wisata',
            'wisata' => TourPlace::where('id', $id)->get()->first(),
        ]);
    }

    public function carts()
    {
        return view('dashboard.pengunjung.wisata.index', [
            'title' => 'Wisata',
            'wisata_' => TourPlace::all(),
        ]);
    }

    public function add()
    {
        $wisata = TourPlace::where('id', auth()->user()->id)->get()->first();
        if ($wisata != null) abort(
            Inertia::render('errors/404')
        );

        return Inertia::render('Dashboard/Pengelola/AddWisata', [
            'title' => 'Tambah Wisata',
        ]);
    }

    public function addStore(Request $request)
    {
        // dd($request->all());

        TourPlace::create([
            'id' => auth()->user()->id,
            'name' => Str::title($request->name),
            'city' => Str::title($request->city),
            'address' => Str::title($request->address),
            'description' => ucfirst($request->description),
            'ticket_stock' => $request->ticket_stock,
            'price' => $request->price,
            'telp' => $request->telp,
            'image' => 'default.jpg',
            'rental' => $request->rental,
        ]);

        return redirect()->route('list-wisata');
    }
}
