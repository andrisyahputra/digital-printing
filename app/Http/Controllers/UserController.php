<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function dashboard()
    {
        // return dd('admin');
        $data['title'] = 'User-Dashboard';
        $data['page'] = 'dashboard';
        return view('user.dashboard', $data);
    }
    public function pesanan_saya()
    {
        // return dd('admin');
        $data['title'] = 'Pesanan Saya';
        $data['page'] = 'pesanan';
        $data['pesanans'] = auth()->user()->pesanans->groupBy('order_id');
        // dd($data['pesanans']);
        return view('user.pesanan-saya', $data);
    }
}
