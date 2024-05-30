<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Access;
use App\Models\Tags;
use App\Models\Tasks;
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
        while ($i <= $request->get('countTag')):
            if (!empty($request->get('tag_'.$i))) {
                $obTag = new Tags();
                $obTag->todoId  = $obTodo->id;
                $obTag->userId  = (int)$request->get('userId');
                $obTag->tag     = $request->get('tag_'.$i);
                $obTag->save();
            }
            $i++;
        endwhile;
        $i = 0;
        while ($i <= $request->get('countTask')):
            if (!empty($request->get('task_'.$i))) {
                $obTask = new Tasks();
                $obTask->todoId  = $obTodo->id;
                $obTask->task    = $request->get('task_'.$i);
                $obTask->save();
            }
            $i++;
        endwhile;

        return redirect( route(\App\Http\Controllers\TodoController::ROUTE_CREATE));
    }

    /**
     * "Todo" update
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $obTodo = (new Todo())->where('id', (int)$request->get('todoId'))->first();
        $obTodo->name   = $request->get('name');
        $obTodo->text   = $request->get('text');
        $sFileImgPath = storage_path('app/public/' . $obTodo['img']);
        if (!empty($request->file()['img'])) {
            if ($request->file()['img']->getClientOriginalName() == 'delete') {
                if (!empty($obTodo['img'])) {
                    unlink($sFileImgPath);
                }
                $obTodo->img = null;
            }
        }
        if (!empty($request->file()) && $request->file()['img']->getClientOriginalName() != 'delete'){
            if (file_exists($sFileImgPath)) {
                if (!empty($obTodo['img'])) {
                    unlink($sFileImgPath);
                }
            }
            $fileName       = time().'_'.str_replace(' ', '', $request->file('img')->getClientOriginalName());
            $filePath       = $request->file('img')->storeAs('/uploads', $fileName , 'public');
            $obTodo->img    = $filePath;
        }
        $obTodo->update();

        (new Tags())->where('todoId', (int)$request->get('todoId'))->delete();
        $i = 0;
        while ($i <= $request->get('countTags')):
            if (!empty($request->get('tag_'.$i))) {
                $obTag = new Tags();
                $obTag->todoId  = (int)$request->get('todoId');
                $obTag->userId  = (int)$obTodo->userId;
                $obTag->tag     = $request->get('tag_'.$i);
                $obTag->save();
            }
            $i++;
        endwhile;

        (new Tasks())->where('todoId', (int)$request->get('todoId'))->delete();
        $i = 0;
        while ($i <= $request->get('countTasks')):
            if (!empty($request->get('task_'.$i))) {
                $obTask = new Tasks();
                $obTask->todoId  = (int)$request->get('todoId');
                $obTask->task    = $request->get('task_'.$i);
                $obTask->status  = $request->get('taskStatus_'.$i);
                $obTask->save();
            }
            $i++;
        endwhile;

        return redirect( route(\App\Http\Controllers\PublicController::ROUTE_MAIN));
    }

    /**
     * Delete "todo"
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        $obTodo = (new Todo())->where('id', $id)->first();
        $sFileImgPath = storage_path('app/public/' . $obTodo['img']);
        if (file_exists($sFileImgPath)) {
            if (!empty($obTodo['img'])) {
                unlink($sFileImgPath);
            }
        }
        $obTodo->delete();
        (new Tags())->where('todoId', $id)->delete();
        (new Access())->where('todoId', $id)->delete();
        (new Tasks())->where('todoId', $id)->delete();

        return redirect( route(\App\Http\Controllers\PublicController::ROUTE_MAIN));
    }
}
