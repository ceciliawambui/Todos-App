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
    public function show(Todo $todo){
        // use this display something after /todos/you enter anything and its displayed
        // dd($todoid);
        return view('todos.show')->with('todo', $todo);

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
        
        // flass message to tell user what is happening in the app
        session()->flash('success', 'Todo created successfully');

        return redirect('/todos');
    }
    // type hint that you need the todo and so you won't need to find the todo as it will automatically get the todo for you
    public function edit(Todo $todo){
        // $todo = Todo::find($todoid);

        return view('todos.edit')->with('todo', $todo);

    }
    public function update(Todo $todo){
        // validates the data added on the name and descripion part

        $this ->validate(request(),[
            'name' => 'required|min:6 |max:12',
            'description' => 'required',

        ]);

        // gets all the data
        $data = request()->all();

        // finds the specific todo using the id

        // $todo = Todo::find($todoid);
        // assigns new values to name and description

        $todo->name = $data['name'];
        $todo->description = $data['description'];

        // flash message to display what is happening 

        session()->flash('success', 'Todo updated successfully');

        // saves the data

        $todo->save();

        // redirecs to the todos part after saving
        return redirect('/todos');
    }
    public function destroy(Todo $todo){
        // finds the specific id to delete

        // $todo=Todo::find($todoid);

        // delete the todo that has been found

        // flash message to delete

        session()->flash('success', 'Todo deleted successfully');

        $todo->delete();

        // redirect to the todos page
        return redirect('/todos');


    }
    public function complete(Todo $todo){
 
        $todo->completed = true;

        $todo->save();

        session()->flash("success","Todo successfully completed");

        return redirect ('/todos');


    }
    
}
