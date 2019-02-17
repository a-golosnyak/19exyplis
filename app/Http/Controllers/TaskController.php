<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class TaskController extends Controller
{
    public function submit(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:150',
            'description' => 'required|max:1500',
            'user_id' =>'required'
        ]);

        $task = new Task;
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->user_id = $request->input('user_id');

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

        if(Auth::user()->id == $tasks[0]->user_id)
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
                'user_id' => 'required',
            ]);

        $task = new Task;
        $task->id = $request->input('id');
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->user_id = $request->input('user_id');

        $tasks = Task::where('id', $task->id)->get();

        if(Auth::user()->id == $tasks[0]->user_id)
        {
            Task::where('id', $task->id)
             ->update(['title'=>$task->title,
                        'description'=>$task->description,
                        'user_id'=>$task->user_id]);

            return redirect("/")->with('status', 'Task updated');
        }
        else
        {
            abort(403);
        }
    }
    
    public function getTasks()
    {
        if(isset(Auth::user()->id)) {
            $tasks = Task::where('user_id', (Auth::User()->id))->orderBy('id', 'desc')->get();
            return view('tasks', ['tasks' => $tasks]);
        }
        else{
            return view('home');
        }

    }

    public function getTask($id)
    {
        $task = Task::where('id', $id)->get();

        return view('task', ['tasks' => $task]);
    }

    public function delete($id)
    {
        $task = Task::where('id', $id)->get();

        if(Auth::user()->id == $task[0]->user_id)
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
