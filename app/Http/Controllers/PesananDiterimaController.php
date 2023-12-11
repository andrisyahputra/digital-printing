<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\PesananDiterima;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Auth\PhotoTrait;
use Illuminate\Support\Facades\Validator;

class PesananDiterimaController extends Controller
{
    use PhotoTrait;
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
                'foto' => ['required', 'image', 'mimes:png,jpg', 'max:1000'],
                'pesanan_id' => ['required', 'string'],
                'order_id' => ['required'],
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validate();
            if ($request->hasFile('foto')) {
                $data['foto'] = $this->uploadPhoto($request, 'foto', 'public/produk/bukti');
            }
            $data['user_id'] = auth()->user()->id;
            // dd($data);
            PesananDiterima::create($data);
            $pesanan = Pesanan::where('order_id', $request->order_id);
            if ($pesanan->count() == 0) {
                return redirect()->back()->with('erorr', 'Pesanan tidak ditemukan');
            }
            $pesanan->update(['status' => 'diterima']);
            DB::commit();
            return redirect()->route('pesanan-saya.show', $data['order_id'])->with('success', 'Berhasil Dikirim');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::debug($th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Masalah');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PesananDiterima $pesananDiterima)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PesananDiterima $pesananDiterima)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PesananDiterima $pesananDiterima)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PesananDiterima $pesananDiterima)
    {
        //
    }
}
