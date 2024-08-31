<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskCreated;


class TodoController extends Controller
{
    //
    public function index(){
        $tasks = Todo::all();
        return view('viewall', compact('tasks'));
    }
    public function create(){  
        return view('maketask');
    }
    public function store(Request $request){
        $validate = $request->validate([
            'task_name'=>'required',
            'task_date'=>'required',
            'task_reason'=>'required',
            'task_type'=>'required',
            'task_email'=>'required',
            'upload_image'=>'required',
        ]);

        $todo = Todo::create([
            'task_name'=>$request->task_name,
            'task_date'=>$request->task_date,
            'task_reason'=>$request->task_reason,
            'task_type'=>$request->task_type,
            'task_email'=>$request->task_email,
            'upload_image'=>$request->upload_image,
        ]);

        Mail::to($todo->task_email)->send(new TaskCreated($todo));


        return back()->with('good', 'YOU HAVE MADE A NEW TASK');
    }

    public function edit($id){
        $todo = Todo::findOrFail($id);
        return view('edit', compact('todo'));
    }

    public function update(Request $request, $id){
        $validate = $request->validate([
            'task_name'=>'required',
            'task_date'=>'required',
            'task_reason'=>'required',
            'task_type'=>'required',
            'task_email'=>'required',
            'upload_image'=>'required',
        ]);

        $todo = Todo::findOrFail($id);
        $todo->update([
            'task_name'=>$request->task_name,
            'task_date'=>$request->task_date,
            'task_reason'=>$request->task_reason,
            'task_type'=>$request->task_type,
            'task_email'=>$request->task_email,
            'upload_image'=>$request->upload_image,
        ]);

        return redirect()->route('todo.index')->with('good', 'TASK UPDATED SUCCESSFULLY');
    }

    public function destroy($id){
        $todo = Todo::findOrFail($id);
        $todo->delete();
        return redirect()->route('todo.index')->with('good', 'TASK DELETED SUCCESSFULLY');
    }



}


