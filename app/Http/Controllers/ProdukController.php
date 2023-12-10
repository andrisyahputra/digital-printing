<?php

namespace App\Http\Controllers;

use Directory;
use App\Models\Kontak;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\Auth\PhotoTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Auth\PhotoTrait;
use Illuminate\Support\Facades\Validator;
// use App\Traits;

class ProdukController extends Controller
{
    use PhotoTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['pesanans'] = Kontak::latest()->take(2)->get();
        $data['totalPesanan'] = Kontak::count();
        $data['transaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->take(2);
        $data['totalTransaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->count();
        $data['title'] = 'Produk';
        $data['page'] = 'produk';
        $data['menu'] = 'index';
        $data['produks'] = Produk::all();
        return view('admin.produk.produk_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // $data['title'] = 'Produk';
        // $data['page'] = 'produk';
        // $data['menu'] = 'create';
        // $data['categories'] = Kategori::all();
        $data['pesanans'] = Kontak::latest()->take(2)->get();
        $data['totalPesanan'] = Kontak::count();
        $data['transaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->take(2);
        $data['totalTransaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->count();
        $data['model'] = new Produk;
        $data['title'] = 'Tambah Produk Baru';
        $data['route'] = 'produk.store';
        $data['method'] = 'POST';
        $data['kategoris'] = Kategori::pluck('nama', 'id');

        return view('admin.produk.produk_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'foto' => ['required', 'image', 'mimes:png,jpg', 'max:1000'],
                'nama' => ['required', 'string', 'max:50'],
                'harga' => ['required'],
                'stok' => ['required', 'numeric', 'min:1'],
                'deskripsi' => ['required'],
                'kategori_id' => ['required', 'numeric']
            ]);
            $kategori = Kategori::where('id', $request->kategori_id)->firstOrFail();
            // dd($kategori->nama);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validate();
            $data['harga'] = str_replace(',', '', $request->harga);
            if ($request->hasFile('foto')) {
                // $file = $request->file('foto');
                // // dd($file);
                // $ext = $file->getClientOriginalExtension();
                // $filename = time() . '.' . $ext;
                // $path = $file->storeAs('public/produk', $filename);
                $data['foto'] = $this->uploadPhoto($request, 'foto', 'public/produk/' . $kategori->nama);
            }
            Produk::create($data);
            DB::commit();
            return redirect()->route('produk.index')->with('success', 'Berhasil Simpan data');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::debug($th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Masalah');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
        $data['pesanans'] = Kontak::latest()->take(2)->get();
        $data['totalPesanan'] = Kontak::count();
        $data['transaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->take(2);
        $data['totalTransaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->count();
        $data['title'] = 'Detail Produk';
        $data['produk'] = $produk;
        $data['kategoris'] = Kategori::all();
        $data['kerajangs'] = null;

        if (Auth::check()) {
            $data['kerajangs'] = auth()->user()->kerajangs;
        }
        return view('front.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
        $data['pesanans'] = Kontak::latest()->take(2)->get();
        $data['totalPesanan'] = Kontak::count();
        $data['transaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->take(2);
        $data['totalTransaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->count();
        $data['model'] = $produk;
        $data['title'] = 'Edit Produk';
        $data['route'] = ['produk.update', $produk->id];
        $data['method'] = 'PUT';
        $data['kategoris'] = Kategori::pluck('nama', 'id');
        return view('admin.produk.produk_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        //
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'foto' => ['nullable', 'image', 'mimes:png,jpg,gif,webp', 'max:1000'],
                'nama' => ['required', 'string', 'max:50'],
                'harga' => ['required'],
                'stok' => ['required', 'numeric'],
                'deskripsi' => ['required'],
                'kategori_id' => ['required', 'numeric']
            ]);
            $kategori = Kategori::where('id', $request->kategori_id)->firstOrFail();
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validate();
            $data['harga'] = str_replace(',', '', $request->harga);
            if ($request->hasFile('foto')) {
                // if ($produk->foto && Storage::exists($produk->foto)) {
                //     Storage::delete($produk->foto);
                // }
                // $file = $request->file('foto');
                // $ext = $file->getClientOriginalExtension();
                // $filename = time() . '.' . $ext;
                // $path = $file->storeAs('public/produk', $filename);
                // $data['foto'] = $path;
                $data['foto'] = $this->uploadPhoto($request, 'foto', 'public/produk/' . $kategori->nama, $produk->foto);
            } else {
                unset($data['foto']);
            }
            $produk->update($data);
            DB::commit();
            return redirect()->route('produk.index')->with('success', 'Berhasil Ubah data');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::debug($th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Masalah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        try {
            //code...
            DB::beginTransaction();
            if ($produk->foto && Storage::exists($produk->foto)) {
                Storage::delete($produk->foto);
            }
            $produk->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Berhasil di hapus !');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            Log::debug('ProdukController::destroy()' . $th->getMessage());
            return redirect()->back()->with('success', 'Terjadi Masalah');
        }
    }
}
