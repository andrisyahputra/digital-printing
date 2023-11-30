<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\PesananDikirim;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PesananDikirimController extends Controller
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
            $validator = Validator::make($request->all(),[
                'order_id'=>'required',
                'resi'=>'required',
                'expedisi'=>'required'
            ]);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validated();
            PesananDikirim::create($data);
            $pesanan = Pesanan::where('order_id', $request->order_id    );
                if($pesanan->count() == 0){
                    return redirect()->back()->with('erorr', 'Pesanan tidak ditemukan');
                }
                $pesanan->update(['status'=>'dikirim']);
            Db::commit();
            return redirect()->back()->with('success', 'berhasil Dikirim');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            Log::error($th);
            return redirect()->back()->with('error', 'Terjadi Masalah');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PesananDikirim $pesananDikirim)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PesananDikirim $pesananDikirim)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PesananDikirim $pesananDikirim)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PesananDikirim $pesananDikirim)
    {
        //
    }
}
