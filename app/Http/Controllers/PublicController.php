<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    /** @var string  */
    const ROUTE_MAIN = 'index';

    /** @var string  */
    const ROUTE_AUTH = 'auth';

    /** @var string  */
    const ROUTE_REGISTER = 'register';

    /** @var string  */
    const ROUTE_GUEST = 'guest';

    /**
     * Index
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Auth
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function auth()
    {
        return view('auth.auth');
    }

    /**
     * Register
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Guest
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function guest()
    {
        return view('layouts.guest');
    }
}
