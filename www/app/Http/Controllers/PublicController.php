<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Tags;
use App\Models\Tasks;
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

    /** @var string  */
    const ROUTE_USER = 'user';

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
            $arAllTags = (new Tags())->where('todoId', $value['id'])->get(['tag']);
            foreach ($arAllTags as $value) {
                $arAvailableTags[] = $value['tag'];
            }
        }
        if (!empty($request->request->get('search'))) {
            unset($arTodo);
            $arTodo = (new Todo())->where('name', $request->request->get('search'))->get();
        }
        if (count($request->request) > 2 && empty($request->request->get('search')) ) {
            unset($arTodo);
            $request->request->remove('_method');
            $request->request->remove('_token');
            foreach ($request->request as $value) {
                $obTags[] = (new Tags())->where('tag', $value)->get('todoId');
                foreach ($obTags as $v) {
                    foreach ($v as $todoId) {
                        $arTodoIdForFilter[] = $todoId->todoId;
                    }
                }
            }
            $arTodo = (new Todo())->whereIn('id', $arTodoIdForFilter)->get();
        }
        foreach ($arTodo as $key => $value) {
            $arTags = (new Tags())->where('todoId', $value['id'])->get();
            foreach ($arTags as $arTag) {
                $tags[$key][] = ['tag' => $arTag->tag];
            }
            $arTasks = (new Tasks())->where('todoId', $value['id'])->get();
            foreach ($arTasks as $arTask) {
                $tasks[$key][] = [
                    'task'      => $arTask->task,
                    'status'    => $arTask->status,
                ];
            }
            $arTodo[$key]['tags']   = $tags[$key] ?? null;
            $arTodo[$key]['tasks']  = $tasks[$key] ?? null;
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
            'arAvailableTags' => array_unique($arAvailableTags) ?? [],
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

    /**
     * User
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function user()
    {
        return view('user');
    }
}
