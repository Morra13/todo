<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Tags;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    /** @var string  */
    const ROUTE_ADD_ACCESS = 'addAccess';

    /** @var string  */
    const ROUTE_MY_ACCESS = 'myAccess';

    /**
     * Add access
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function addAccess($id)
    {
        $obAccess = (new Access())->where('todoId', $id)->where('userId', auth()->user()->id)->first();
        if ($obAccess && $obAccess->type == 'all') {
            $arUsersText = [];
            $arTodo = (new Todo())->where('id', $id)->first();
            $arAccess = (new Access())->where('todoId', $arTodo->id)->get();

            foreach ($arAccess as $value) {
                $user = (new User())->where('id', $value->userId)->first();
                $access[] = [
                    "id" => $value['id'],
                    "userId" => $user->id,
                    "userName" => $user->name,
                    "type" => $value['type'],
                ];
            }

            $arTodo['access'] = $access ?? null;
            $arUsers = User::all()->except(auth()->id());

            return view('access.addAccess', [
                'arTodo' => $arTodo,
                'arUsers' => $arUsers,
            ]);
        }
        return redirect( route(\App\Http\Controllers\PublicController::ROUTE_MAIN) );
    }

    /**
     * "Todo" available to me
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function myAccess()
    {
        $arTodo = [];
        $arAccess = (new Access())->where('userId', auth()->id())->get(['todoId', 'userId', 'type']);

        foreach ($arAccess as $key => $access) {
            $arTodo[$key] = (new Todo())->where('id', $access->todoId)->first();
            $arTodo[$key]['type'] = $access->type;
        }
        foreach ($arTodo as $key => $value) {
            $arTags = (new Tags())->where('todoId', $value['id'])->get();
            foreach ($arTags as $arTag) {
                $tags[$key][] = ['tag' => $arTag->tag];
            }
            $arTodo[$key]['tags'] = $tags[$key] ?? null;
        }

        return view('access.myAccess', ['arTodo' => $arTodo]);
    }
}
