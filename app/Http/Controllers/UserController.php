<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function dashboard()
    {
        // return dd('admin');
        $data['title'] = 'User-Dashboard';
        $data['page'] = 'dashboard';
        return view('user.dashboard.index', $data);
    }
    public function pesanan_saya()
    {
        // return dd('admin');
        $data['title'] = 'Pesanan Saya';
        $data['page'] = 'pesanan';
        $data['pesanans'] = auth()->user()->pesanans->groupBy('order_id');
        // dd($data['pesanans']);
        return view('user.pesanan.pesanan-saya', $data);
    }
    public function show($slug)
    {
        // return dd($slug);
        $pesanan = auth()->user()->pesanans->where('order_id', $slug);
        // dd($pesanan);
        // $pesanan = Pesanan::where('order_id', $order_id);
        if ($pesanan->count() == 0) {
            return abort(404);
        }
        $data['title'] = 'Detail Pesanan';
        $data['page'] = 'pesanan';
        $data['menu'] = 'show';
        $data['pesanans'] = $pesanan;
        $data['subtotal'] = $pesanan->sum('total');
        return view('user.pesanan.show', $data);
    }
}
