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
    public function edit($todoid){
        $todo = Todo::find($todoid);

        return view('todos.edit')->with('todo', $todo);

    }
    public function update($todoid){
        // validates the data added on the name and descripion part

        $this ->validate(request(),[
            'name' => 'required|min:6 |max:12',
            'description' => 'required',

        ]);

        // gets all the data
        $data = request()->all();

        // finds the specific todo using the id

        $todo = Todo::find($todoid);
        // assigns new values to name and description

        $todo->name = $data['name'];
        $todo->description = $data['description'];

        // saves the data

        $todo->save();

        // redirecs to the todos part after saving
        return redirect('/todos');
    }
    public function destroy($todoid){
        // finds the specific id to delete

        $todo=Todo::find($todoid);

        // delete the todo that has been found
        $todo->delete();

        // redirect to the todos page
        return redirect('/todos');


    }
    
}
