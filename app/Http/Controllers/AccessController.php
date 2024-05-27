<?php

namespace App\Http\Controllers;

use App\Models\Access;
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
     * Дать доступы
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function addAccess($id)
    {
        $arUsersText = [];
        $arTodo = (new Todo())->where('id', $id)->first();
        $arAccess = (new Access())->where('todoId', $arTodo->id)->get();

        foreach ($arAccess as $value) {
            $user = (new User())->where('id', $value->userId)->first();
            $access[] = [
                "id"        => $value['id'],
                "userId"    => $user->id,
                "userName"  => $user->name,
                "type"      => $value['type'],
            ];
        }

        $arTodo['access'] = $access ?? null;
        $arUsers = User::all()->except(auth()->id());
        foreach ($arUsers as $user) {
            $arUsersText[] = $user['name'] ." ID: ". $user['id'];
        }

        return view('access.addAccess', [
            'arTodo'    => $arTodo,
            'sUsers'    => implode("\n", $arUsersText),
        ]);
    }

    public function myAccess()
    {
        return view('access.myAccess');
    }
}