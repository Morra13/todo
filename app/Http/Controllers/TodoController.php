<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('todo.change');
    }
}
