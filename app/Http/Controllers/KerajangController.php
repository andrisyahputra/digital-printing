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
        if (auth()->user()->kerajangs->count() == 0) {
            return redirect()->route('produk')->with('error', 'Keranjang Kosong, Silakan Belanja');
        }
        $data['title'] = env('APP_NAME');
        $data['kerajangs'] = auth()->user()->kerajangs;


        return view('front.keranjang', $data);
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
        if (auth()->user()->kerajangs->count() == 0) {
            return redirect()->route('produk')->with('error', 'Keranjang Kosong, Silakan Belanja');
        }
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
                // Pesanan::create([
                //     'order_id' => $order_id,
                //     'user_id' => $user_id,
                //     'produk_id' => $item->produk->id,
                //     'nama' => $item->produk->nama,
                //     'harga' => $item->produk->harga,
                //     'kuantitas' => $item->kuantitas,
                //     'total' => $item->produk->harga * $item->kuantitas
                // ]);
                // $item->produk->kurangi_stok($item->kuantitas);
                // $total_harga += $item->produk->harga * $item->kuantitas;
                // $item->delete();
                if ($item->produk->stok >= $item->kuantitas) {
                    // Proceed with creating the order
                    Pesanan::create([
                        'order_id' => $order_id,
                        'user_id' => $user_id,
                        'produk_id' => $item->produk->id,
                        'nama' => $item->produk->nama,
                        'harga' => $item->produk->harga,
                        'kuantitas' => $item->kuantitas,
                        'total' => $item->produk->harga * $item->kuantitas
                    ]);

                    // Reduce stock
                    $item->produk->kurangi_stok($item->kuantitas);

                    // Update total harga
                    $total_harga += $item->produk->harga * $item->kuantitas;

                    // Remove item from the cart
                    $item->delete();
                } else {
                    // If stock is less than quantity, cancel checkout for this item
                    // You can handle this situation as needed, e.g., return an error response
                    return redirect()->back()->with('error', $item->produk->nama . ' stok ini tidak mencukupi');
                    // return response()->json(['error' => 'Not enough stock for ' . $item->produk->nama], 400);
                }
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
            // return redirect($response->redirect_url);
            return $response;
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
    public function destroy(kerajang $keranjang)
    {
        // return 'test';
        // return dd($keranjang->id);
        try {
            if (!Auth::check()) {
                return redirect()->route('login');
            }

            DB::beginTransaction();
            // dd($keranjang->user_id . ' & ' . auth()->user()->id);

            // Hanya pemilik keranjang yang bisa menghapusnya
            if ($keranjang->user_id !== auth()->user()->id) {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menghapus keranjang ini.');
            }

            $keranjang->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Keranjang berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::debug($th->getMessage());
            return redirect()->back()->with('error', 'Terjadi masalah saat menghapus keranjang.');
        }
    }
}
