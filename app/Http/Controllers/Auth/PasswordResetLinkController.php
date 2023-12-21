<?php

namespace App\Http\Controllers\Auth;

use App\Models\Footer;
use Illuminate\View\View;
use App\Models\MediaSosial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        // return view('auth.forgot-password');
        $data['kerajangs'] = null;
        $data['footer'] = Footer::firstOrNew();
        $data['footer'] = $data['footer'] ?? null;

        $data['medsos'] = MediaSosial::firstOrNew();
        $data['medsos'] = $data['medsos'] ?? null;
        return view('auth.forgotpassword_onlineshop', $data);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }
}
