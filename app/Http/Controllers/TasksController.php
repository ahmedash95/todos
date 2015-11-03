<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TasksController extends Controller
{

    public function index(){
    	$tasks = Task::get();
        return view('tasks.index')->with('tasks',$tasks);
    }

    public function createTask(Request $request){
    	$task = new Task;
    	$task->task_name = $request->get('task_name');
    	$task->save();
    	return redirect()->back();
    }

    public function markAsDone($id){
    	// Please find this task by id , if task not exists please return error
    	$task = Task::findOrFail($id);
    	$task->is_done = true; // or replace true by 1 
    	$task->update(); // you can use save() method instead of update
    	return Response::json([
            'text' => 'Mark As UnDone',
            'link' => url('/tasks/'.$id.'/undone'),
            'class' => 'btn btn-warning btn-xs',
        ]);
    }    
    public function unmarkAsDone($id){
    	// Please find this task by id , if task not exists please return error
    	$task = Task::findOrFail($id);
    	$task->is_done = false; // or replace true by 1 
    	$task->update(); // you can use save() method instead of update
        return Response::json([
            'text' => 'Mark As Done',
            'link' => url('/tasks/'.$id.'/done'),
            'class' => 'btn btn-success btn-xs',
        ]);
    }

    public function edit($id){
    	$task = Task::findOrFail($id);
    	return view('tasks.edit')->with('task',$task);
    }
    public function update(Request $request, $id){
    	$task = Task::findOrFail($id);
    	$task->task_name = $request->get('task_name');
    	$task->is_done = $request->get('is_done');
    	$task->update();
    	return redirect()->to('/tasks');    	
    }
    public function destroy(Request $request, $id){
    	$task = Task::findOrFail($id);
    	$task->delete();
        return Response::json(['success' => 1, 'message' => 'task deleted','tasks_count' => Task::count() ]);
    }
}
