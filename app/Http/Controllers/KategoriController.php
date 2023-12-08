<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Helper\FormHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['title'] = 'Kategori';
        $data['page'] = 'kategori';
        $data['kategoris'] = Kategori::all();


        return view('admin.kategori.index', $data);
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
        // return response()->json('berhasil', 200);
        try {
            //code...
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'nama' => ['required']
            ]);
            if ($validator->fails()) {
                return FormHelper::response_json(false, 'input tidak valid', $validator->errors(), 401);
            }
            $data = $validator->validated();
            Kategori::create($data);
            DB::commit();
            session()->flash('success', 'Simpan');
            return FormHelper::response_json(true, 'berhasil simpan data', route('kategori.index'), 200);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            Log::debug('KategoriController::store()' . $th->getMessage());
            return FormHelper::response_json(false, 'terjadi masalahh', $th->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
        try {
            //code...
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'nama' => ['required']
            ]);
            if ($validator->fails()) {
                return FormHelper::response_json(false, 'input tidak valid', $validator->errors(), 401);
            }
            $data = $validator->validated();
            $kategori->update($data);
            DB::commit();
            session()->flash('success', 'Diubah');
            return FormHelper::response_json(true, 'berhasil simpan data', route('kategori.index'), 200);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            Log::debug('KategoriController::update()' . $th->getMessage());
            return FormHelper::response_json(false, 'terjadi masalahh', $th->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        //
        try {
            //code...
            DB::beginTransaction();
            $kategori->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Berhasil di hapus !');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            Log::debug('KategoriController::destroy()' . $th->getMessage());
            return redirect()->back()->with('success', 'Terjadi Masalah');
        }
    }
}
