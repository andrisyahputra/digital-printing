<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\Kontak;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Traits\ConvertContentImageBase64ToUrl;

class FooterController extends Controller
{
    use ConvertContentImageBase64ToUrl;
    //
    public function index()
    {
        $data['pesanans'] = Kontak::latest()->take(2)->get();
        $data['totalPesanan'] = Kontak::count();
        $data['transaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->take(2);
        $data['totalTransaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->count();
        $data['model'] = Footer::firstOrNew();
        $data['model'] = $data['model'] ?? new Footer;
        // $data['model'] = new Setting;
        $data['route'] = 'footer.store';
        $data['method'] = 'POST';
        $data['title'] = 'Setting Bagian Footer';
        // $masjid = auth()->user()->masjid;
        // $masjid = $masjid ?? new Masjid;
        return view('admin.setting.form_footer', $data);
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'fot_tentang' => ['required'],
                'fot_alamat' => ['required'],
                'fot_kontak' => ['required'],
                'fot_jambuka' => ['required'],
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validate();
            $setting = Footer::firstOrNew();
            $setting = $setting ?? new Footer;

            $setting->fot_tentang = $data['fot_tentang'] = $this->convertBase64ImagesToUrls($data['fot_tentang'], 'public/footer');
            $setting->fot_alamat = $data['fot_alamat'] = $this->convertBase64ImagesToUrls($data['fot_alamat'], 'public/footer');
            $setting->fot_kontak = $data['fot_kontak'] = $this->convertBase64ImagesToUrls($data['fot_kontak'], 'public/footer');
            $setting->fot_jambuka = $data['fot_jambuka'] = $this->convertBase64ImagesToUrls($data['fot_jambuka'], 'public/footer');
            $setting->save();
            // $masjid = auth()->user()->masjid;
            // $masjid = $masjid ?? new Masjid;

            DB::commit();
            return redirect()->route('footer.index')->with('success', 'Berhasil Simpan data');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::debug($th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Masalah');
        }
    }
}
