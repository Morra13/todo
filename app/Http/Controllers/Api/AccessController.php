<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Access;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    /** @var string  */
    const ROUTE_ADD_ACCESS = 'api.addAccess';

    /** @var string  */
    const ROUTE_DELETE_ACCESS = 'api.deleteAccess';

    /**
     * Add access
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addAccess(Request $request)
    {
        $obAccess = (new Access())
            ->where('todoId', $request->get('todoId'))
            ->where('userId', $request->get('userId'))
            ->first()
        ;
        if ($obAccess) {
            $obAccess->type = $request->get('type');
            $obAccess->update();
        } else {
            $obAccess = new Access();
            $obAccess->todoId       = $request->get('todoId');
            $obAccess->type         = $request->get('type');
            $obAccess->userId       = $request->get('userId');
            $obAccess->todoUserId   = $request->get('todoUserId');
            $obAccess->save();
        }

        return redirect( route(\App\Http\Controllers\AccessController::ROUTE_ADD_ACCESS, $request->get('todoId')));
    }

    /**
     * Delete access
     *
     * @param $userId
     * @param $todoId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAccess($userId, $todoId)
    {
        (new Access())
            ->where('todoId', $todoId)
            ->where('userId', $userId)
            ->delete()
        ;

        return redirect()->back();
    }
}
