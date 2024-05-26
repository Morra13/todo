<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use App\Models\Todo;
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
        $arTodo = (new Todo())->where('userId', auth()->id())->get();

        foreach ($arTodo as $key => $value) {
            $arTags = (new Tags())->where('todoId', $value['id'])->get();
            foreach ($arTags as $arTag) {
                $tags[$key][] = ['tag' => $arTag->tag];
            }
            $arTodo[$key]['tags'] = $tags[$key] ?? null;
        }

        return view('index', ['arTodo' => $arTodo]);
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
