<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\TourPlace;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard/Pengunjung/Keranjang', [
            'title' => 'Keranjang',
            'carts' => Cart::with('tour_place')->where('user_id', auth()->user()->id)->get(),
        ]);
    }

    public function add(Request $request, $id)
    {
        // dd($request->rental);
        $priceKamera = 50000;

        $id_auth = auth()->user()->id;
        $price = TourPlace::find($id)->price;
        $cart = Cart::where('user_id', $id_auth)->pluck('tour_place_id');

        // Sewa kamera
        $totalPayment = $request->quantity * $price;
        if ($request->rental == null) {
            $sewaKamera = 0;
        } else {
            $sewaKamera = $priceKamera;
        }
        $totalPayment = ($request->quantity * $price) + $sewaKamera;

        // Cek jika item sudah ada dikeranjang
        foreach ($cart as $crt) {
            if ($crt == $id) {
                $cart = Cart::where('tour_place_id', $crt);
                $oldQuantity = $cart->pluck('quantity')->first();
                $newQuantity = $oldQuantity + $request->quantity;

                // dd($request->all());

                if ($request->rental) {
                    $sewaKamera = $priceKamera;
                } else {
                    $sewaKamera = 0;
                }
                $totalPayment = ($newQuantity * $price) + $sewaKamera;

                $cart->update([
                    'quantity' => $newQuantity,
                    'total_payment' => $totalPayment,
                    'price_kamera' => $sewaKamera,
                ]);

                return redirect("list-wisata/$id");
            }
        }

        Cart::create([
            'user_id' => $id_auth,
            'tour_place_id' => $id,
            'quantity' => $request->quantity,
            'total_payment' => $totalPayment,
            'price_kamera' => $sewaKamera,
        ]);

        return redirect("list-wisata/$id")->with('success', 'Item ditambahkan ke keranjang.');
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $priceKamera  = 50000;

        $cart = Cart::find($id);

        if ($request->sewaKamera == true) {
            $totalPayment = ($request->quantity * $cart->tour_place->price) + $priceKamera;
        } else {
            $totalPayment = $request->quantity * $cart->tour_place->price;
        }

        $cart->update([
            'quantity' => $request->quantity,
            'total_payment' => $totalPayment,
            'price_kamera' => ($request->sewaKamera == true) ? $priceKamera : 0,
        ]);

        return redirect()->route('carts');
    }

    public function destroy($id)
    {
        Cart::destroy($id);
    }

    public function checkout($id)
    {
        // dd(Cart::find($id));
        return redirect()->route('pesanan');
    }

    public function getCart($id)
    {
        return Cart::with('tour_place')->where('id', $id)->get();
    }
}
