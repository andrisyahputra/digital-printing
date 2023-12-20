<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\Pesanan;
use App\Models\MediaSosial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MediaSosialController extends Controller
{
    //
    public function index()
    {
        $data['pesanans'] = Kontak::latest()->take(2)->get();
        $data['totalPesanan'] = Kontak::count();
        $data['transaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->take(2);
        $data['totalTransaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->count();
        $data['model'] = MediaSosial::firstOrNew();
        $data['model'] = $data['model'] ?? new MediaSosial;
        // $data['model'] = new Setting;
        $data['route'] = 'medsos.store';
        $data['method'] = 'POST';
        $data['title'] = 'Setting Media Sosial';
        // $masjid = auth()->user()->masjid;
        // $masjid = $masjid ?? new Masjid;
        return view('admin.setting.form_medsos', $data);
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'fb' => ['required'],
                'ig' => ['required'],
                'yt' => ['required'],
                'twitter' => ['required'],
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validate();
            $medsos = MediaSosial::firstOrNew();
            $medsos = $medsos ?? new MediaSosial;

            $medsos->fb = $data['fb'];
            $medsos->ig = $data['ig'];
            $medsos->yt = $data['yt'];
            $medsos->twitter = $data['twitter'];
            $medsos->save();

            DB::commit();
            return redirect()->route('medsos.index')->with('success', 'Berhasil Simpan data');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::debug($th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Masalah');
        }
    }
}
