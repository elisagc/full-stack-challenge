<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Task;
use App\Status;

class Controller extends BaseController
{
    use ValidatesRequests;

    public function index()
    {
        return view('index', [
            'tasks'  => Task::all(),
            'status' => Status::all()       
        ]);
    }
}
