<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Tags;
use App\Models\Todo;
use App\Models\User;
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
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $arTodo = (new Todo())->where('userId', auth()->id())->get();
        foreach ($arTodo as $value) {
            $arAllTags = (new Tags())->where('todoId', $value['id'])->get(['todoId' ,'tag']);
            foreach ($arAllTags as $value) {
                $arAvailableTags[] = [$value['todoId'] => $value['tag']];
            }
        }
        if (!empty($request->request->get('search'))) {
            unset($arTodo);
            $arTodo[] = (new Todo())->where('name', $request->request->get('search'))->first();
        }
        if (count($request->request) > 2 && empty($request->request->get('search')) ) {
            unset($arTodo);
            $request->request->remove('_method');
            $request->request->remove('_token');
            foreach ($request->request as $value) {
                $arTodoIdForFilter[] = $value;
            }
            foreach (array_unique($arTodoIdForFilter) as $todoId) {
                $arTodo[] = (new Todo())->where('id', $todoId)->first();
            }
        }
        foreach ($arTodo as $key => $value) {
            $arTags = (new Tags())->where('todoId', $value['id'])->get();
            foreach ($arTags as $arTag) {
                $tags[$key][] = ['tag' => $arTag->tag];
            }
            $arTodo[$key]['tags'] = $tags[$key] ?? null;
            $obAccess = (new Access())->where('todoId', $value['id'])->get();
            foreach ($obAccess as $arAccess) {
                $user = (new User())->where('id', $arAccess->userId)->first();
                $access[$key][] = [
                    'name' => $user->name,
                ];
            }
            $arTodo[$key]['access'] = $access[$key] ?? null;
        }

        return view('index', [
            'arTodo' => $arTodo,
            'arAvailableTags' => $arAvailableTags ?? [],
        ]);
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
