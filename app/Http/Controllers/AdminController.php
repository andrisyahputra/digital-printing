<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        // return dd('admin');
        $tahun = date('Y');
        $bulan = date('m');
        for ($i = 1; $i <= $bulan; $i++) {
            $totalInfak = Transaksi::whereYear('created_at', $tahun)->whereMonth('created_at', $i)->where('status', 'success')->sum('harga');
            // $dataBulan[] = Carbon::create()->month($i)->format('F');
            $dataBulan[] = ubahAngkaToBulan($i);
            $dataTotalBulan[] = $totalInfak;
        }

        $data['dataBulan'] = $dataBulan;
        $data['dataTotalBulan'] = $dataTotalBulan;
        $data['pendapatanHariIni'] = Transaksi::whereDate('created_at', now()->format('Y-m-d'))->where('status', 'success')->sum('harga');

        $data['pesans'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->take(5);
        $data['title'] = 'Analytics Dashboard';
        $data['pesanans'] = Kontak::latest()->take(2)->get();
        $data['totalPesanan'] = Kontak::count();
        $data['transaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->take(2);
        $data['totalTransaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->count();
        $data['page'] = 'dashboard';
        // $pesanan = Pesanan::where('order_id', $data['transaksi']);
        // $data['subtotal'] = $pesanan->sum('total');
        return view('admin.dashboard.index', $data);
    }
}
