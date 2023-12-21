<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Footer;
use Illuminate\View\View;
use App\Models\MediaSosial;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
// use App\Traits\PhotoTrait;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth\uploadPhoto;

class RegisteredUserController extends Controller
{
    use PhotoTrait;
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $data['kerajangs'] = null;
        $data['footer'] = Footer::firstOrNew();
        $data['footer'] = $data['footer'] ?? null;

        $data['medsos'] = MediaSosial::firstOrNew();
        $data['medsos'] = $data['medsos'] ?? null;
        // return view('auth.register_onlineshop', $data);
        return view('auth.register_onlineshop', $data);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'notelp' => ['required', 'string', 'max:13', 'unique:' . User::class],
            'nowa' => ['required', 'string', 'max:13', 'unique:' . User::class],
            'foto' => ['required', 'image', 'mimes:png,jpg', 'max:1000'],
            'password' => ['required', 'min:8', 'confirmed', Rules\Password::defaults()],
        ]);
        // dd($request->foto);
        // dd($this->uploadPhoto($request->foto, 'foto', 'public/users/foto'));
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'notelp' => $request->notelp,
            'nowa' => $request->nowa,
            'password' => Hash::make($request->password),
            'foto' => $this->uploadPhoto($request, 'foto', 'public/users/foto'),
        ]);
        $user->assignRole('User');


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
