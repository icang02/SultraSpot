<?php

namespace App\Http\Controllers;

use App\Models\PengelolaOrder;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Inertia\Inertia;


class UserOrderController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id == 1) {
            $this->authorize('pengunjung');
        } else if (auth()->user()->role_id == 2) {
            $orders = UserOrder::with('tour_place')->where('user_id', auth()->user()->id)->orderBy('no_order')->get();
        } else if (auth()->user()->role_id == 3) {
            $orders = PengelolaOrder::with('tour_place')->where('tour_place_id', auth()->user()->id)->orderBy('no_order')->get();
        }

        return Inertia::render('Dashboard/Pengunjung/Pesanan', [
            'orders' => $orders,
        ]);
    }

    public function show($id)
    {
        if (auth()->user()->role_id == 2) {
            $order = UserOrder::with('tour_place', 'user')->find($id);
            $date = $order->created_at->format('Y-m-d H:i:s');
        } else if (auth()->user()->role_id == 3) {
            $order = PengelolaOrder::with('tour_place', 'user')->find($id);
            $date = $order->created_at->format('Y-m-d H:i:s');
        }

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
        $pathPengunjung = 'bukti-tf/pengunjung/';
        $pathPengelola = 'bukti-tf/pengelola/';

        $request->file('image')->move($pathPengunjung, $imgName);

        if (!is_dir($pathPengelola)) {
            mkdir($pathPengelola);
        }
        copy($pathPengunjung . $imgName, $pathPengelola . $imgName);

        UserOrder::find($id)->update([
            'image_tf' => $imgName,
        ]);
        PengelolaOrder::find($id)->update([
            'image_tf' => $imgName,
        ]);

        return redirect()->route('pesanan');
    }

    public function orderConfirm($id)
    {
        // dd(request()->all());
        if (request()->status == 'selesai') $status = 'selesai';
        else if (request()->status == 'gagal') $status = 'gagal';

        $userOrder = UserOrder::find($id);
        $pengelolaOrder = PengelolaOrder::find($id);

        $userOrder->update([
            'status' => $status,
        ]);
        $pengelolaOrder->update([
            'status' => $status,
        ]);

        return redirect()->route('pesanan');
    }

    public function delete($id)
    {

        $userOrder = UserOrder::find($id);
        $pengelolaOrder = PengelolaOrder::find($id);

        if (auth()->user()->role_id == 2) {
            $imgName = $userOrder->image_tf;
            unlink('bukti-tf/pengunjung/' . $imgName);
            $userOrder->delete();
        } else if (auth()->user()->role_id == 3) {
            $imgName = $pengelolaOrder->image_tf;
            unlink('bukti-tf/pengelola/' . $imgName);
            $pengelolaOrder->delete();
        }

        return redirect()->route('pesanan');
    }
}
