<?php

namespace App\Http\Controllers;

use App\Models\AlamatUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateAlamatUserRequest;

class AlamatUserController extends Controller
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
        try {
            // dd($request->all());
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'alamat_users' => 'required',
                'provinsi' => 'required',
                'distrik' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validate();
            $data['kota'] = $data['distrik'];
            unset($data['distrik']);
            $data['user_id'] = auth()->user()->id;
            // dd($data);
            $alamat = AlamatUser::create($data);

            $user = auth()->user();
            $user->alamat_id = $alamat->id;
            $user->save();
            DB::commit();
            return redirect()->back()->with('success', 'Berhasil Tambah Alamat');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::debug($th->getMessage());
            // return dd(auth()->user()->id); //melihat eror
            return redirect()->back()->with('error', 'Terjadi Masalah');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AlamatUser $alamatUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AlamatUser $alamatUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AlamatUser $alamat)
    {
        //
        // dd($alamat);
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'alamat_users' => 'required',
                'provinsi' => 'required',
                'distrik' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validate();
            $data['kota'] = $data['distrik'];
            unset($data['distrik']);
            $data['user_id'] = auth()->user()->id;
            // dd($data);
            $alamat->update($data);

            $user = auth()->user();
            $user->alamat_id = $alamat->id;
            $user->save();
            DB::commit();
            return redirect()->back()->with('success', 'Berhasil Diubah data');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::debug($th->getMessage());
            return redirect()->back()->with('error', 'Terjadi Masalah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AlamatUser $alamatUser)
    {
        //
    }
}
