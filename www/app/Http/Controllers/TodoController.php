<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Tags;
use App\Models\Tasks;
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
        $arTodo     = (new Todo())->where('id', $id)->first();
        $obAccess = (new Access())->where('todoId', $id)->where('userId', auth()->user()->id)->first();
        if ($arTodo) {
            if ($arTodo->userId == auth()->user()->id || $obAccess && $obAccess->type == 'all') {
                $arTag = [];
                $arTags     = (new Tags())->where('todoId', $id)->get();
                $arTasks    = (new Tasks())->where('todoId', $id)->get();
                if (!empty($arTags)) {
                    foreach ($arTags as $key => $value) {
                        $arTag[$key] = [
                            "id"    => $value->id,
                            "tag"   => $value->tag,
                        ];
                    }
                    $arTodo['tags'] = $arTag;
                }
                if (!empty($arTasks)) {
                    foreach ($arTasks as $key => $value) {
                        $arTask[$key] = [
                            "id"        => $value->id,
                            "task"      => $value->task,
                            "status"    => $value->status,
                        ];
                    }
                    $arTodo['tasks'] = $arTasks;
                }

                return view('todo.change', ['arTodo' => $arTodo]);
            }
        }

        return redirect( route(\App\Http\Controllers\PublicController::ROUTE_MAIN) );
    }
}
