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

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        $data['kerajangs'] = null;
        $data['footer'] = Footer::firstOrNew();
        $data['footer'] = $data['footer'] ?? null;

        $data['medsos'] = MediaSosial::firstOrNew();
        $data['medsos'] = $data['medsos'] ?? null;
        if (Auth::check()) {
            $data['kerajangs'] = auth()->user()->kerajangs;
            $data['alamatUser'] = auth()->user()->alamat;
        }
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(RouteServiceProvider::HOME)
            : view('auth.verifyemail_onlineshop', $data);
        // : redirect()->route('/email/verify');
    }
}
