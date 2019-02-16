<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use DB;
use Illuminate\Support\Factaskes\Auth;

class TaskController extends Controller
{
    public function submit(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:150',
            'description' => 'required|max:1500',
            'author' => 'required'
        ]);

        $task = new Task;
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->author = $request->input('author');
        $task->created_at = date("Y-m-d H:i:s");
        $task->save();

        $task->id = DB::getPdo()->lastInsertId();
        return redirect("/$task->id")->with('status', 'Task created');
    }

    public function createTask()
    {
        return view('edit', ['title' => '',
                            'description' => '',
                            'but' => 'Create',
                            'action'=>'edit/submit',
                            'id'=>'0']);
    }
    
    public function editTask($id)
    {  
        $tasks = Task::where('id', "$id")->get();

        if(Auth::user()->name == $tasks[0]->author)
        {
            $action = 'edit/edit/';
            return view('/edit', [  'title'=>$tasks[0]->title,
                                    'description' => $tasks[0]->description,
                                    'but' => 'Save',
                                    'action' => $action,
                                    'id'=>$id]);
        }
        else
        {
            abort(403);
        }
    }

    public function updateTask(Request $request)
    {
        $this->validate($request, [
                'title' => 'required',
                'description' => 'required',
                'author' => 'required',
                'id' => 'required'
            ]);

        $task = new Task;
        $task->id = $request->input('id');
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->author = $request->input('author');

        $tasks = Task::where('id', $task->id)->get();

        if(Auth::user()->name == $tasks[0]->author)
        {
            Task::where('id', $task->id)
             ->update(['title'=>$task->title,
                        'description'=>$task->description,
                        'author'=>$task->author]);

            return redirect("/")->with('status', 'Task updated');
        }
        else
        {
            abort(403);
        }
    }
    
    public function getTasks()
    {
        $tasks = Task::orderBy('id', 'desc')->paginate(5);

        return view('tasks', ['tasks' => $tasks]);
    }

    public function getTask($id)
    {
        $task = Task::where('id', $id)->get();
        $task[0]->created_at = substr($task[0]->created_at, 0, strpos($task[0]->created_at, ' '));

        return view('task', ['tasks' => $task]);
    }

    public function delete($id)
    {
        $task = Task::where('id', $id)->get();

        if(Auth::user()->name == $task[0]->author)
        {
            $task = Task::where('id', $id)->delete();
            return redirect("/")->with('status', 'Task deleted');
        }
        else
        {
            abort(403);
        }
    }
}
