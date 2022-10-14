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
        return Inertia::render('Dashboard/Pengunjung/Pesanan', [
            'orders' => UserOrder::where('user_id', auth()->user()->id)->get(),
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
