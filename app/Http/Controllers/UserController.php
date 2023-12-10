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
        $data['title'] = 'Selamat Datang Di Toko Online';
        $data['page'] = 'dashboard';
        $data['pesansBayar'] = auth()->user()->pesanans->where('status', 'success')->sortByDesc('created_at')->groupBy('order_id')->take(2);
        $data['pesansBelum'] = auth()->user()->pesanans->where('status', 'pending')->sortByDesc('created_at')->groupBy('order_id')->take(2);



        $data['transaksi'] = auth()->user()->pesanans->sortByDesc('created_at')->groupBy('order_id')->take(2);
        $data['totalTransaksi'] = auth()->user()->pesanans->groupBy('order_id')->count();
        return view('user.dashboard.index', $data);
    }
    public function index()
    {
        // return dd('admin');
        $data['title'] = 'Pesanan Saya';
        $data['page'] = 'pesanan';
        $data['pesanans'] = auth()->user()->pesanans->groupBy('order_id');
        $data['transaksi'] = auth()->user()->pesanans->sortByDesc('created_at')->groupBy('order_id')->take(2);
        $data['totalTransaksi'] = auth()->user()->pesanans->groupBy('order_id')->count();
        // dd($data['pesanans']);
        return view('user.pesanan.pesanan-saya', $data);
    }
    public function show(Request $request, $order_id = null)
    {
        // return dd($order_id);
        $order_id = $order_id ?: $request->input('order_id');

        $pesanan = auth()->user()->pesanans->where('order_id', $order_id);
        // dd($pesanan);
        // $pesanan = Pesanan::where('order_id', $order_id);
        // if ($pesanan->count() == 0) {
        //     return abort(404);
        // }
        $data['transaksi'] = auth()->user()->pesanans->sortByDesc('created_at')->groupBy('order_id')->take(2);
        $data['totalTransaksi'] = auth()->user()->pesanans->groupBy('order_id')->count();
        $data['title'] = 'Detail Pesanan';
        $data['page'] = 'pesanan';
        $data['menu'] = 'show';
        if ($pesanan->count() != 0) {
            $data['pesanans'] = $pesanan;
            $data['subtotal'] = $pesanan->sum('total');
        } else {
            $data['pesanans'] = null;
        }

        return view('user.pesanan.show', $data);
    }
}
