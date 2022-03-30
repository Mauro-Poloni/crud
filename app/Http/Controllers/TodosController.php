<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;

class TodosController extends Controller
{
    /**
     * index para mostrar todos los todos
     * store para guardar un todo
     * update para actualizar un todo
     * destroy para eliminar un todo
     * edit para mostrar el formulario de edicion
     */

     public function store(Request $request) {
        //Validamos
        $request->validate([
            'title'=>'required|min:3'
        ]);
        //Creamos los valores y asignamos las variables
        $todo  = new Todo;
        $todo->title = $request->title;
        $todo->category_id = $request->category_id;
        $todo->save();
        //redirigiendo el usuario a todos y mostramos un mensaje
        return redirect()->route('usuarios')->with('success', 'Usuario creado correctamente');
     }

     public function index() {
        $todos = Todo::all();
        $categories = Category::all();
        return view('todos.index', ['todos' => $todos, 'categories' => $categories]);
    }

    public function show($id) {
        $todo = Todo::find($id);
        return view('todos.show', ['todo' => $todo]);
    }

    public function update(Request $request, $id) {
        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->save();
        return redirect()->route('todos')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy($id) {
       $todo = Todo::find($id);
       $todo->delete();
       return redirect()->route('todos')->with('success', 'Usuario eliminado correctamente');
    }
}
