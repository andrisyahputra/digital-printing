<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{
    //
    public function index()
    {
        $data['title'] = env('APP_NAME');
        $data['kategoris'] = Kategori::all();
        $data['produks'] = Produk::all();
        $data['kerajangs'] = null;

        if (Auth::check()) {
            $data['kerajangs'] = auth()->user()->kerajangs;
        }


        return view('front.index', $data);
    }
    public function kontak()
    {
        $data['title'] = env('APP_NAME');
        $data['kerajangs'] = null;

        if (Auth::check()) {
            $data['kerajangs'] = auth()->user()->kerajangs;
        }


        return view('front.kontak', $data);
    }
    public function produk(Request $request)
    {
        $data['title'] = env('APP_NAME');
        $data['kategoris'] = Kategori::all();
        // if()

        $data['produks'] = Produk::all();
        $data['produks'] = DB::table('produks')->when($request->input('search'), function ($query, $search) {
            $query->where('nama', 'like', '%' . $search . '%');
        })->get();
        $data['kerajangs'] = null;

        if (Auth::check()) {
            $data['kerajangs'] = auth()->user()->kerajangs;
        }


        return view('front.produk', $data);
    }
    public function kategori($kategori)
    {
        // $data['title'] = env('APP_NAME');
        $data['kategoris'] = Kategori::all();
        // $data['produks'] = Produk::all();
        // dd($kategori);
        // $kategoriModel = Kategori::find($kategori);
        // $data['model'] = Produk::where('kategori_id', $kategori)->first();
        $data['produks'] = Produk::where('kategori_id', $kategori)->get();
        // dd($data['produks']);
        $data['kerajangs'] = null;

        if (Auth::check()) {
            $data['kerajangs'] = auth()->user()->kerajangs;
        }


        return view('front.produk', $data);
    }
}
