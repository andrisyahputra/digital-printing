<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $data['pesanans'] = Kontak::latest()->take(2)->get();
        $data['totalPesanan'] = Kontak::count();
        $data['transaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->take(2);
        $data['totalTransaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->count();
        $data['title'] = 'Pesanan';
        $data['page'] = 'pesanan';
        $data['menu'] = 'index';
        $data['pesans'] = Pesanan::all()->groupBy('order_id');
        // $data['pesans'] = Pesanan::all()->groupBy($request->input('order_id'));
        // $data['pesans'] = DB::table('pesanans')->when($request->input('search'), function ($query, $search) {
        //     $query->where('nama', 'like', '%' . $search . '%');
        // })->get();

        return view('admin.pesanan.index', $data);
    }

    public function tolak(Request $request)
    {
        try {
            DB::beginTransaction();
            if (empty($request->order_id) || !isset($request->order_id)) {
                return abort(404);
            }
            $order_id = $request->order_id;
            $pesanan = Pesanan::where('order_id', $order_id);
            if ($pesanan->count() == 0) {
                return abort(404);
            }
            foreach ($pesanan->get() as $pesan) {
                Produk::find($pesan->produk_id)->tambahi_stok($pesan->kuantitas);
                if ($pesan->status == 'pending') {
                    $pesan->status = 'cancel';
                    $pesan->save();
                }
                if ($pesan->status == 'success') {
                    $pesan->status = 'tolak';
                    $pesan->update();
                }
            }
            $tranksaksi = Transaksi::where('order_id', $order_id);
            $tranksaksi->update(['status' => 'cancel']);
            DB::commit();
            return redirect()->back()->with('success', 'pesanan berhasil ditolak');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
            return redirect()->back()->with('error', 'Terjadi masalah');
        }
    }
    public function terima(Request $request)
    {

        try {
            DB::beginTransaction();
            if (empty($request->order_id) || !isset($request->order_id)) {
                return abort(404);
            }
            $order_id = $request->order_id;
            $pesanan = Pesanan::where('order_id', $order_id);
            if ($pesanan->count() == 0) {
                return abort(404);
            }
            $pesanan->update(['status' => 'diproses']);
            DB::commit();
            return redirect()->back()->with('success', 'pesanan berhasil diterima');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
            return redirect()->back()->with('error', 'Terjadi masalah');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $order_id = null)
    {
        // dd($request->order_id);
        $order_id = $order_id ?: $request->input('order_id');

        $pesanan = Pesanan::where('order_id', $order_id);
        // if ($pesanan->count() == 0) {
        //     return abort(404);
        // }

        $data['title'] = 'Detail Pesanan';
        $data['page'] = 'pesanan';
        $data['menu'] = 'show';
        $data['pesanans'] = Kontak::latest()->take(2)->get();
        $data['totalPesanan'] = Kontak::count();
        $data['transaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->take(2);
        $data['totalTransaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->count();
        if ($pesanan->count() != 0) {
            $data['pesans'] = $pesanan->get();
            $data['subtotal'] = $pesanan->sum('total');
        } else {
            $data['pesans'] = null;
        }

        return view('admin.pesanan.show', $data);
    }
    public function cari(Request $request)
    {
        // $pesanan = Pesanan::where('order_id', $request->order_id);
        // // $pesanan = Pesanan::where('order_id', Request->input('order_id'));
        // if ($pesanan->count() == 0) {
        //     return abort(404);
        // }
        // $data['title'] = 'Detail Pesanan';
        // $data['page'] = 'pesanan';
        // $data['menu'] = 'show';
        // $data['pesanans'] = Kontak::latest()->take(2)->get();
        // $data['totalPesanan'] = Kontak::count();
        // $data['transaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->take(2);
        // $data['totalTransaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->count();
        // $data['pesans'] = $pesanan->get();
        // $data['subtotal'] = $pesanan->sum('total');
        // return view('admin.pesanan.show', $data);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pesanan $pesanan)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pesanan $pesanan)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesanan $pesanan)
    {
    }
}
