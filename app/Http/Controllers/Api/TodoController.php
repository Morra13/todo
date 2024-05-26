<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tags;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE = 'api.create';

    /** @var string  */
    const ROUTE_UPDATE = 'api.update';

    /** @var string  */
    const ROUTE_DELETE = 'api.delete';

    /**
     * Create "todo"
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(Request $request)
    {
        $obTodo = new Todo();

        $obTodo->userId = $request->get('userId');
        $obTodo->name   = $request->get('name');
        $obTodo->text   = $request->get('text');
        if (!empty($request->file())){
            $fileName       = time().'_'.str_replace(' ', '', $request->file('img')->getClientOriginalName());
            $filePath       = $request->file('img')->storeAs('/uploads', $fileName , 'public');
            $obTodo->img    = $filePath;
        }
        $obTodo->save();

        $i = 0;
        while ($i <= $request->get('count')):
            if (!empty($request->get('tag_'.$i))) {
                $obTag = new Tags();
                $obTag->todoId  = $obTodo->id;
                $obTag->userId  = (int)$request->get('userId');
                $obTag->tag     = $request->get('tag_'.$i);
                $obTag->save();
            }
            $i++;
        endwhile;

        return redirect( route(\App\Http\Controllers\TodoController::ROUTE_CREATE));
    }


    public function update(Request $request)
    {
        $obTodo = (new Todo())->where('id', (int)$request->get('id'))->first();
        dd($obTodo);
    }

    public function delete($id)
    {
        dd($id);
    }
}
