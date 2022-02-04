<?php

namespace App\Http\Controllers;

// NOTE THIS, not App\Todo;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    public function index(){
        // fetch all todos from the database
        // display them on the view
        $todos=Todo::all();
        return view('todos.index')->with('todos', $todos);
    }
    public function show($todoid){
        // use this display something after /todos/you enter anything and its displayed
        // dd($todoid);
        return view('todos.show')->with('todo', Todo::find($todoid));

    }
    public function create(){
        return view('todos.create');
    }
    public function store(){
        // dd(request()->all());
// to make sure that you have to add a name and description before creating a todo
        $this ->validate(request(),[
            'name' => 'required|min:6 |max:12',
            'description' => 'required',

        ]);
        $data = request()->all();

        $todo = new Todo();
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->completed = false;

        $todo->save();

        return redirect('/todos');
    }
    
}
