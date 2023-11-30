<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
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

            if(Auth::check()){
                $data['kerajangs'] = auth()->user()->kerajangs;
            }


        return view('index', $data);
    }
}
