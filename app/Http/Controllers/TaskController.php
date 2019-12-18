<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * 建立一個新的控制器實例。
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
       // return view('tasks.index');
        //顯示已有的任務
        //由 DB 擷取使用者所有任務
        $tasks = Task::where('user_id', $request->user()->id)->get();

        //$tasks= auth()->user()->tasks;
        // 取得登入之User的所有tasks

        //測試 認證->使用者->任務->get
        //$tasks= auth()->user()->tasks()->get();

        //取得登入之User的所有tasks_2
        //$tasks=Auth::user()->tasks;

        //測試 認證->使用者->任務->get_2
        //$tasks=Auth::user()->tasks()->get();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        //建立任務
        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);
        return redirect('/tasks');
    }
    /**
     * 移除給定的任務。
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);
        $task->delete();
        return redirect('/tasks');

    }
}
