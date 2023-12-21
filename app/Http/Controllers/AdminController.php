<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\Pesanan;
use App\Models\Setting;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Auth\PhotoTrait;
use Illuminate\Support\Facades\Validator;
use App\Traits\ConvertContentImageBase64ToUrl;

class AdminController extends Controller
{
    //
    use PhotoTrait;
    use ConvertContentImageBase64ToUrl;
    public function dashboard()
    {
        // return dd('admin');
        $tahun = date('Y');
        $bulan = date('m');
        for ($i = 1; $i <= $bulan; $i++) {
            $totalInfak = Transaksi::whereYear('created_at', $tahun)->whereMonth('created_at', $i)->where('status', 'success')->sum('harga');
            // $dataBulan[] = Carbon::create()->month($i)->format('F');
            $dataBulan[] = ubahAngkaToBulan($i);
            $dataTotalBulan[] = $totalInfak;
        }
        $data['dataPertahun'] = Transaksi::whereYear('created_at', $tahun)->where('status', 'success')->sum('harga');
        $data['dataBulan'] = $dataBulan;
        $data['dataTotalBulan'] = $dataTotalBulan;
        $data['pendapatanHariIni'] = Transaksi::whereDate('created_at', now()->format('Y-m-d'))->where('status', 'success')->sum('harga');

        $data['pesans'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->take(5);
        $data['title'] = 'Analytics Dashboard';
        $data['pesanans'] = Kontak::latest()->take(2)->get();
        $data['totalPesanan'] = Kontak::count();
        $data['transaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->take(2);
        $data['totalTransaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->count();
        $data['page'] = 'dashboard';
        // $pesanan = Pesanan::where('order_id', $data['transaksi']);
        // $data['subtotal'] = $pesanan->sum('total');
        return view('admin.dashboard.index', $data);
    }

    public function setting()
    {
        $data['pesanans'] = Kontak::latest()->take(2)->get();
        $data['totalPesanan'] = Kontak::count();
        $data['transaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->take(2);
        $data['totalTransaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->count();
        $data['model'] = Setting::firstOrNew();
        $data['model'] = $data['model'] ?? new Setting;
        // $data['model'] = new Setting;
        $data['route'] = 'setting.store';
        $data['method'] = 'POST';
        $data['title'] = 'Setting Halaman Depan';
        // $masjid = auth()->user()->masjid;
        // $masjid = $masjid ?? new Masjid;
        return view('admin.setting.form_setting', $data);
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'gambar_depan' => ['nullable', 'image', 'mimes:png,jpg', 'max:5000'],
                'gdepan_ket' => ['required'],
                'maps' => ['required'],
                'produk_kami' => ['required'],
                'hub_kami' => ['required'],
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validate();
            $setting = Setting::firstOrNew();
            $setting = $setting ?? new Setting;

            $setting->maps = $data['maps'];
            if ($request->hasFile('gambar_depan')) {
                $setting->gambar_depan = $data['gambar_depan'] = $this->uploadPhoto($request, 'gambar_depan', 'public/setting');
            } else {
                unset($data['gambar_depan']);
            }
            $setting->gdepan_ket = $data['gdepan_ket'] = $this->convertBase64ImagesToUrls($data['gdepan_ket'], 'setting');
            $setting->produk_kami = $data['produk_kami'] = $this->convertBase64ImagesToUrls($data['produk_kami'], 'setting');
            $setting->hub_kami = $data['hub_kami'] = $this->convertBase64ImagesToUrls($data['hub_kami'], 'setting');
            $setting->save();
            // $masjid = auth()->user()->masjid;
            // $masjid = $masjid ?? new Masjid;

            DB::commit();
            return redirect()->route('admin.setting')->with('success', 'Berhasil Simpan data');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::debug($th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Masalah');
        }
    }
}
