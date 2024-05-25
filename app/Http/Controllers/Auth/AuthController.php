<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /** @var string  */
    const ROUTE_AUTH = 'api.auth.auth';

    /** @var string  */
    const ROUTE_LOGOUT = 'api.auth.logout';

    /** @var string  */
    const ROUTE_REGISTER = 'api.auth.register';

    /**
     * Auth
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route(\App\Http\Controllers\PublicController::ROUTE_MAIN);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Logout
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout (Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route(\App\Http\Controllers\PublicController::ROUTE_MAIN);
    }

    /**
     * Register
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register (Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route(\App\Http\Controllers\PublicController::ROUTE_MAIN);
    }
}
