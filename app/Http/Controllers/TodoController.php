<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use App\Models\Todo;

class TodoController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE = 'create';

    /** @var string  */
    const ROUTE_CHANGE = 'change';

    /**
     * Create "todo"
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Change "todo"
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function change($id)
    {
        $arTag = [];

        $arTodo = (new Todo())->where('id', $id)->first();
        $arTags = (new Tags())->where('todoId', $id)->get();

        if (!empty($arTags)) {
            foreach ($arTags as $key => $value) {
                $arTag[$key] = [
                    "id"    => $value->id,
                    "tag"   => $value->tag,
                ];
            }
            $arTodo['tags'] = $arTag;
        }

        return view('todo.change', ['arTodo' => $arTodo]);
    }
}
