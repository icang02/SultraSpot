<?php

namespace App\Http\Controllers;

use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

use function GuzzleHttp\Promise\all;

class UserOrderController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id == 1) {
            $this->authorize('pengunjung');
        } else if (auth()->user()->role_id == 2) {
            $orders = UserOrder::with('tour_place')->where('user_id', auth()->user()->id)->orderBy('no_order')->get();
        } else if (auth()->user()->role_id == 3) {
            $orders = UserOrder::with('tour_place')->where('tour_place_id', auth()->user()->id)->orderBy('no_order')->get();
        }

        return Inertia::render('Dashboard/Pengunjung/Pesanan', [
            'orders' => $orders,
        ]);
    }

    public function show($id)
    {

        $order = UserOrder::with('tour_place')->find($id);
        $date = $order->created_at->format('Y-m-d H:i:s');

        return Inertia::render('Dashboard/Pengunjung/PesananShow', [
            'title' => 'Detail Pesanan',
            'order' => $order,
            'date_order' => $date,
        ]);
    }

    public function uploadBuktiTf(Request $request, $id)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $imgName = uniqid() . '-' . $request->image->getClientOriginalName();
        $pathName = 'img/bukti-tf';
        // move_uploaded_file($imgName);
        $request->file('image')->move($pathName, $imgName);

        UserOrder::find($id)->update([
            'image_tf' => $imgName,
        ]);

        return redirect()->route('pesanan');
    }

    public function orderConfirm($id)
    {
        // dd(request()->all());
        if (request()->status == 'selesai') $status = 'selesai';
        else if (request()->status == 'gagal') $status = 'gagal';

        $order = UserOrder::find($id);
        $order->update([
            'status' => $status,
        ]);

        return redirect()->route('pesanan');
    }

    public function delete($id)
    {
        // dd($id);
        $userOrder = UserOrder::find($id);
        $imgName = $userOrder->image_tf;

        unlink('img/bukti-tf/' . $imgName);

        $userOrder->delete();

        return redirect()->route('pesanan');
    }
}
