<?php

namespace App\Http\Controllers;

use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Inertia\Inertia;

class UserOrderController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id == 1) {
            $this->authorize('pengunjung');
        } else if (auth()->user()->role_id == 2) {
            $orders = UserOrder::with('tour_place')->where('user_id', auth()->user()->id)->get();
        } else if (auth()->user()->role_id == 3) {
            $orders = UserOrder::with('tour_place')->where('tour_place_id', auth()->user()->id)->get();
        }

        return Inertia::render('Dashboard/Pengunjung/Pesanan', [
            'orders' => $orders,
        ]);
    }

    public function show($id)
    {
        $orders = UserOrder::where('user_id', $id)->get();
        // dd(count($orders));

        Blade::directive('rupiah', function ($expression) {
            return "Rp. <?php echo number_format($expression,0,',','.'); ?>";
        });

        return view('dashboard.pengunjung.pesanan.detail', [
            'title' => 'Pesanan',
            'user_order' => $orders,
        ]);
    }
}
