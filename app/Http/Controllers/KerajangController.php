<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\kerajang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KerajangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // return dd($request->all());
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'produk_id' => ['required', 'numeric'],
                'kuantitas' => ['required', 'numeric', 'min:1']
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validate();
            $data['user_id'] = auth()->user()->id;

            kerajang::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Berhasil Simpan di Keranjang');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::debug($th->getMessage());
            // return dd(auth()->user()->id); //melihat eror
            return redirect()->back()->with('error', 'Terjadi Masalah');
        }
    }

    public function checkout()
    {
        try {
            Config::$serverKey = env('MIDTRANS_API_KEY');
            Config::$isProduction = env('IS_PRODUCTION');
            Config::$isSanitized = true;
            Config::$is3ds = true;
            Config::$overrideNotifUrl = route('payment.notify');

            $order_id = 'TRX-' . time();
            $user_id = auth()->user()->id;
            $kerajangs = auth()->user()->kerajangs;

            $total_harga = 0;
            foreach ($kerajangs as $item) {
                Pesanan::create([
                    'order_id' => $order_id,
                    'user_id' => $user_id,
                    'produk_id' => $item->produk->id,
                    'nama' => $item->produk->nama,
                    'harga' => $item->produk->harga,
                    'kuantitas' => $item->kuantitas,
                    'total' => $item->produk->harga * $item->kuantitas
                ]);
                $item->produk->kurangi_stok($item->kuantitas);
                $total_harga += $item->produk->harga * $item->kuantitas;
                $item->delete();
            }

            Transaksi::create([
                'order_id' => $order_id,
                'pembeli' => auth()->user()->name,
                'harga' => $total_harga
            ]);

            $params = [
                'transaction_details' => [
                    'order_id' => $order_id,
                    'gross_amount' => $total_harga,
                ]
            ];


            $response = \Midtrans\Snap::createTransaction($params);
            return redirect($response->redirect_url);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi Masalah.');
        }
        // return 'test';
    }

    /**
     * Display the specified resource.
     */
    public function show(kerajang $kerajang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kerajang $kerajang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kerajang $kerajang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kerajang $kerajang)
    {
        // return 'test';
        // return dd($kerajang->id);
        try {
            if (!Auth::check()) {
                return redirect()->route('login');
            }

            DB::beginTransaction();

            // Hanya pemilik keranjang yang bisa menghapusnya
            if ($kerajang->user_id !== auth()->user()->id) {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menghapus keranjang ini.');
            }

            $kerajang->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Keranjang berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::debug($th->getMessage());
            return redirect()->back()->with('error', 'Terjadi masalah saat menghapus keranjang.');
        }
    }
}
