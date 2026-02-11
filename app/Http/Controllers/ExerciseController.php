<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    // GET /api/exercises (es público)
    public function index() {
        return response()->json(Exercise::with('category')->get(), 200);
    }

    // GET /api/exercises/{id} (es público)
    public function show($id) {
        $exercise = Exercise::with('category')->findOrFail($id);
        return response()->json($exercise, 200);
    }

    // Creo el POST
    public function store(Request $request) {
        // Valido: name, desc y cat_id
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'cat_id' => 'required|exists:categories,id'
        ]);

        // Creo el ejercicio, mapeando el 'desc' a la columna 'instruction'
        $exercise = Exercise::create([
            'name' => $validated['name'],
            'instruction' => $validated['desc'], 
            'category_id' => $validated['cat_id']
        ]);

        return response()->json($exercise, 201); // El codigo me indica el exito de la creación.

    }

    // Creo el DELETE
    public function destroy($id) {
        $exercise = Exercise::findOrFail($id);
        $exercise->delete();

        return response()->json(['message' => 'Ejercicio eliminado correctamente.']);
    }
}
