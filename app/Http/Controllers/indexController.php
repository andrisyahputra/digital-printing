<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class indexController extends Controller
{
    //
    public function index()
    {
        // $response = Http::withHeaders([
        //     'key' => 'd2bb878d91c40259cf6d56680055ca35',
        // ])->get('https://api.rajaongkir.com/starter/province');
        // // dd($response->json());
        // $data['provinsi'] = $response['rajaongkir']['results'];

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

    public function store(Request $request)
    {
        // return dd($request->all());
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'nama' => ['required', 'string', 'max:10'],
                'email' => ['required', 'email'],
                'nowa' => ['required', 'string',  'min:12', 'max:13'],
                'pesan' => ['required'],
            ]);
            // $kategori = Kategori::where('id', $request->kategori_id)->firstOrFail();
            // // dd($kategori->nama);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('error', 'Maaf Pesan Gagal Dikirim');
            }
            $data = $validator->validate();
            // $data['harga'] = str_replace(',', '', $request->harga);
            // if ($request->hasFile('foto')) {
            //     // $file = $request->file('foto');
            //     // // dd($file);
            //     // $ext = $file->getClientOriginalExtension();
            //     // $filename = time() . '.' . $ext;
            //     // $path = $file->storeAs('public/produk', $filename);
            //     $data['foto'] = $this->uploadPhoto($request, 'foto', 'public/produk/' . $kategori->nama);
            // }
            Kontak::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Terimakasih Pesan Berhasil Dikirim');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::debug($th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Masalah');
        }
    }
}
