<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\Slider;
use App\Models\Pesanan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Auth\PhotoTrait;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    //
    use PhotoTrait;
    public function index()
    {
        $data['pesanans'] = Kontak::latest()->take(2)->get();
        $data['totalPesanan'] = Kontak::count();
        $data['transaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->take(2);
        $data['totalTransaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->count();
        $data['model'] = Slider::all();
        // $data['model'] = new Setting;
        // $data['route'] = 'footer.store';
        // $data['method'] = 'POST';
        $data['title'] = 'Slider Halaman Depan';
        // $masjid = auth()->user()->masjid;
        // $masjid = $masjid ?? new Masjid;
        return view('admin.setting.slider.slider_index', $data);
    }
    public function create()
    {
        $data['pesanans'] = Kontak::latest()->take(2)->get();
        $data['totalPesanan'] = Kontak::count();
        $data['transaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->take(2);
        $data['totalTransaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->count();

        $data['kategoris'] = Kategori::pluck('nama', 'id');

        $data['model'] = new Slider;
        $data['route'] = 'slider.store';
        $data['method'] = 'POST';
        $data['title'] = 'Tambah Slider Halaman Depan';
        return view('admin.setting.slider.form_slider', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'gambar_slider' => ['required', 'image', 'mimes:png,jpg', 'max:1000'],
                'ket_slider' => ['required', 'string', 'max:20'],
                'kategori_id' => ['required', 'numeric']
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validate();
            if ($request->hasFile('gambar_slider')) {
                $data['gambar_slider'] = $this->uploadPhoto($request, 'gambar_slider', 'public/slider');
            }

            Slider::create($data);
            DB::commit();
            return redirect()->route('slider.index')->with('success', 'Berhasil Simpan data');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::debug($th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Masalah');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        $data['pesanans'] = Kontak::latest()->take(2)->get();
        $data['totalPesanan'] = Kontak::count();
        $data['transaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->take(2);
        $data['totalTransaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->count();

        $data['kategoris'] = Kategori::pluck('nama', 'id');

        $data['model'] = $slider;
        $data['route'] = ['slider.update', $slider->id];
        $data['method'] = 'PUT';
        $data['title'] = 'Edit Slider Halaman Depan';
        return view('admin.setting.slider.form_slider', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'gambar_slider' => ['required', 'image', 'mimes:png,jpg', 'max:1000'],
                'ket_slider' => ['required', 'string', 'max:20'],
                'kategori_id' => ['required', 'numeric']
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validate();
            if ($request->hasFile('gambar_slider')) {
                $data['gambar_slider'] = $this->uploadPhoto($request, 'gambar_slider', 'public/slider');
            } else {
                unset($data['gambar_slider']);
            }

            $slider->update($data);
            DB::commit();
            return redirect()->route('slider.index')->with('success', 'Berhasil Ubah data');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::debug($th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Masalah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        try {
            //code...
            DB::beginTransaction();
            if ($slider->gambar_slider && Storage::exists($slider->gambar_slider)) {
                Storage::delete($slider->gambar_slider);
            }
            $slider->delete();
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
