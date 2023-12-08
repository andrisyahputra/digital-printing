<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Controllers\Auth\PhotoTrait;

class ProfileController extends Controller
{
    use PhotoTrait;
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.profil_edit', [
            'user' => $request->user(),
            'title' => 'Edit Profil',
            'page' => 'profil',
        ]);
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
