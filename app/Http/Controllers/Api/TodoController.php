<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE = 'api.create';

    /** @var string  */
    const ROUTE_DELETE = 'api.delete';

    public function create(Request $request)
    {
        dd($request);
    }

    public function delete($id)
    {
        dd($id);
    }
}
