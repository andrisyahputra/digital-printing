<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kontak;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Auth\PhotoTrait;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    use PhotoTrait;
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        if (auth()->user()->hasRole('User')) {
            $data['transaksi'] = auth()->user()->pesanans->sortByDesc('created_at')->groupBy('order_id')->take(2);
            $data['totalTransaksi'] = auth()->user()->pesanans->groupBy('order_id')->count();
        } else {
            $data['transaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->take(2);
            $data['totalTransaksi'] = Pesanan::orderBy('created_at', 'desc')->get()->groupBy('order_id')->count();
        }
        $data['pesanans'] = Kontak::latest()->take(2)->get();
        $data['totalPesanan'] = Kontak::count();
        $data['user'] = $request->user();
        $data['title'] = 'Edit Profil';
        $data['page'] = 'profil';
        return view('profile.profil_edit', $data);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'notelp' => 'required|string|max:13',
            'nowa' => 'required|string|max:13',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|min:8|max:20',
        ]);

        // dd

        if ($request->password != '') {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }
        if ($request->foto != '') {
            $data['foto'] = $this->uploadPhoto($request, 'foto', 'public/admin/foto', auth()->user()->foto);
        } else {
            unset($data['foto']);
        }
        $user = auth()->user();
        $user->fill($data);
        $user->update();
        return back()->with('success', 'Profil Berhasil Di Update');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
