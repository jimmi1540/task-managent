<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Index()
    {
        $tasks = Task::all();
        return view('tasks.index', ['tasks' => $tasks]);
    }
    public function create()
    {
        return view('tasks.create');
    }
    public function AddTask(Request $request)
    {
        $rules = [
            'title' => 'required|string',
            'description' => 'required|string',
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $task = Task::create($request->all());
        if($task->id)
        {
            session()->flash('success', 'Task Added Successfully.');
            return redirect()->route( 'dashboard' );
        }
         
    }
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', ['task' => $task]);

    }
    public function update(Request $request,$id)
    {
        $update_data =  Task::where('id', $id)->update(['title' => $request->title,
        'description'=>$request->description,
        'status'=>$request->status]
       );
       if($update_data)
       {
           session()->flash('success', 'Task Updated Successfully.');
           return redirect()->route( 'dashboard' );
       }
    }
    public function Destroy($id)
    {
        $task = Task::findOrFail($id);
        $task_deleted = $task->delete();
        if($task_deleted == true)
        {
            session()->flash('success', 'Task Deleted Successfully.');
            return redirect()->route( 'dashboard' );
        }


    }
}
