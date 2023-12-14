<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\kerajang;
use App\Models\Transaksi;
use App\Models\FotoPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Auth\PhotoTrait;
use Illuminate\Support\Facades\Validator;

class KerajangController extends Controller
{
    use PhotoTrait;
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
        $data['alamatUser'] = auth()->user()->alamat;

        $data['kerajangsStiker'] = auth()->user()->kerajangs->where('kategori_id', 1);
        $data['kerajangsSpanduk'] = auth()->user()->kerajangs->where('kategori_id', 2);
        $data['kerajangsKartuNama'] = auth()->user()->kerajangs->where('kategori_id', 3);
        $data['kerajangsBrosur'] = auth()->user()->kerajangs->where('kategori_id', 4);
        $data['kerajangsProduk'] = auth()->user()->kerajangs->where('kategori_id', '>=', 5);


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
                'kuantitas' => ['required', 'numeric', 'min:1'],
                // 'totalHarga' => ['required', 'numeric', 'min:1']
                'panjang' => ['nullable', 'numeric'],
                'lebar' => ['nullable', 'numeric'],
                'kertas' => ['nullable', 'string'],
                'foto' => ['nullable', 'image', 'mimes:png,jpg', 'max:1000'],
                'keterangan' => ['nullable', 'max:30'],
                // 'kuantitas' => ['required', 'numeric', 'min:1']
            ]);
            $produk = Produk::where('id', $request->produk_id)->firstOrFail();
            // dd($validator->errors())->withInput($request->all());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('error', 'Terjadi Masalah');
            }

            $data = $validator->validate();
            $data['user_id'] = auth()->user()->id;
            $data['kategori_id'] = $produk->kategori_id;
            if ($request->hasFile('foto')) {
                $data['foto'] = $this->uploadPhoto($request, 'foto', 'public/keranjang/' . $produk->nama);
            }
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
                if ($item->foto) {
                    // Upload foto untuk keranjang
                    // Pindahkan foto ke folder pesanan
                    $pesananFotoPath = $this->movePhotoToOrderFolder($item->foto, 'public/pesanan/' . $item->produk->nama);
                }

                if ($item->produk->stok >= $item->kuantitas) {
                    // Proceed with creating the order
                    switch ($item->kategori_id) {
                        case 1:
                            //stiker
                            $pesanan = Pesanan::create([
                                'order_id' => $order_id,
                                'user_id' => $user_id,
                                'produk_id' => $item->produk->id,
                                'kategori_id' => $item->kategori_id,
                                'nama' => $item->produk->nama,
                                'harga' => $item->produk->harga,
                                'kuantitas' => $item->kuantitas,
                                'panjang' => $item->panjang,
                                'lebar' => $item->lebar,
                                'keterangan' => $item->keterangan,
                                'total' =>  floatval($item->panjang) * floatval($item->lebar) * $item->produk->harga * $item->kuantitas,
                            ]);
                            FotoPesanan::create([
                                'user_id' => $user_id,
                                'pesanan_id' => $pesanan->id,
                                'foto' => $pesananFotoPath
                            ]);
                            break;
                        case 2:
                            //sapnduk
                            $pesanan = Pesanan::create([
                                'order_id' => $order_id,
                                'user_id' => $user_id,
                                'produk_id' => $item->produk->id,
                                'kategori_id' => $item->kategori_id,
                                'nama' => $item->produk->nama,
                                'harga' => $item->produk->harga,
                                'kuantitas' => $item->kuantitas,
                                'panjang' => $item->panjang,
                                'lebar' => $item->lebar,
                                'keterangan' => $item->keterangan,
                                'total' =>  floatval($item->panjang) * floatval($item->lebar) * $item->produk->harga * $item->kuantitas,
                            ]);
                            FotoPesanan::create([
                                'user_id' => $user_id,
                                'pesanan_id' => $pesanan->id,
                                'foto' => $pesananFotoPath
                            ]);
                            break;
                        case 3:
                            //kartu nama
                            $pesanan = Pesanan::create([
                                'order_id' => $order_id,
                                'user_id' => $user_id,
                                'produk_id' => $item->produk->id,
                                'kategori_id' => $item->kategori_id,
                                'nama' => $item->produk->nama,
                                'harga' => $item->produk->harga,
                                'kuantitas' => $item->kuantitas,
                                'keterangan' => $item->keterangan,
                                'total' =>   $item->produk->harga * $item->kuantitas,
                            ]);
                            FotoPesanan::create([
                                'user_id' => $user_id,
                                'pesanan_id' => $pesanan->id,
                                'foto' => $pesananFotoPath
                            ]);
                            break;
                        case 4:
                            //brosur
                            $pesanan = Pesanan::create([
                                'order_id' => $order_id,
                                'user_id' => $user_id,
                                'produk_id' => $item->produk->id,
                                'kategori_id' => $item->kategori_id,
                                'nama' => $item->produk->nama,
                                'harga' => $item->produk->harga,
                                'kuantitas' => $item->kuantitas,
                                'kertas' => $item->kertas,
                                'keterangan' => $item->keterangan,
                                'total' =>   $item->produk->harga * $item->kuantitas,
                            ]);
                            FotoPesanan::create([
                                'user_id' => $user_id,
                                'pesanan_id' => $pesanan->id,
                                'foto' => $pesananFotoPath
                            ]);
                            break;

                        default:
                            Pesanan::create([
                                'order_id' => $order_id,
                                'user_id' => $user_id,
                                'produk_id' => $item->produk->id,
                                'kategori_id' => $item->kategori_id,
                                'nama' => $item->produk->nama,
                                'harga' => $item->produk->harga,
                                'kuantitas' => $item->kuantitas,
                                'total' => $item->produk->harga * $item->kuantitas
                            ]);
                            break;
                    }


                    // Reduce stock
                    $item->produk->kurangi_stok($item->kuantitas);

                    // Update total harga
                    if ($item->kategori_id == '1' || $item->kategori_id == '2') {
                        //stiker
                        //                 var luas = parseFloat(panjang) * parseFloat(lebar);
                        // var total = luas * jumlah * harga;
                        $luas = floatval($item->panjang) * floatval($item->lebar);
                        $totalSekarang = $luas * $item->produk->harga * $item->kuantitas;
                        $total_harga += $totalSekarang;
                        // } elseif ($item->kategori_id == '2') {
                        // } elseif ($item->kategori_id == '3') {
                        // } elseif ($item->kategori_id == '4') {
                    } else {
                        $total_harga += $item->produk->harga * $item->kuantitas;
                    }
                    // $total_harga += $item->produk->harga * $item->kuantitas;

                    // Remove item from the cart
                    if ($item->foto && Storage::exists($item->foto)) {
                        Storage::delete($item->foto);
                    }
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
