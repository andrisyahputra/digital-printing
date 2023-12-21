<?php

namespace App\Http\Controllers\Auth;

use App\Models\Footer;
use Illuminate\View\View;
use App\Models\MediaSosial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $data['kerajangs'] = null;
        $data['footer'] = Footer::firstOrNew();
        $data['footer'] = $data['footer'] ?? null;

        $data['medsos'] = MediaSosial::firstOrNew();
        $data['medsos'] = $data['medsos'] ?? null;
        return view('auth.login_onlineshop', $data);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
