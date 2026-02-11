<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Routine; 
use App\Http\Requests\StoreRoutineRequest; // Para la validación, punto B
use App\Http\Resources\RoutineResource; // Para el formato JSON, punto A
use Illuminate\Support\Facades\Auth; 

class RoutineController extends Controller
{
    // Este es el GET api/routines
    public function index() {

        // obtenener el usuario autenticado
        $user = Auth::user();

        //acceder a las rutinas a través de la relación.
        // cargar también los ejercicios para una respuesta completa.
        $routines = $user->routines()->with('exercises')->get();

        // A; uso el resource para devolver los datos con el formato
        return RoutineResource::collection($routines);
    }

    // Este es el POST api/routines
    // cambio request por storeroutinerequest
    public function store(StoreRoutineRequest $request) {

        //validar que los datos lleguen correctamente // Lo quito 
        // $request->validate([
        //     'name' => 'required|string',
        //     'exercises' => 'required|array', // esperar una lista de ejercicios
        // ]);

        

        // creo la rutina en la tabla 'routines'
        $routine = Routine::create([
            'name' => request->name,
            'description' => $request->description
        ]);

        // asocio la rutina al usuario autenticado
        // el método de attach inserta una fila en la tabla
        Auth::user()->routines()->attach($routine->id);

        // asocio los ejercicios a la rutina
        // se supone que el json trae 'exercises' como un array de objetos
        foreach ($request->exercises as $ex) {
            $routine->exercises()->attach($ex['exercise_id'], [
                'sequence' => $ex['sequence'],
                'target_sets' => $ex['target_sets'],
                'target_reps' => $ex['target_reps'],
                'rest_seconds' => $ex['rest_seconds'],
            ]);
        }

        // Devuelvo la rutina creada usando el resource (A).
        return new RoutineResource($routine);

    }

    // GET /api/routines (es público - Todas las rutinas del sistema)
    public function index_public() {
        return RoutineResource::collection(Routine::all());
    }

    // GET /api/routines/{id} (es público - Detalle de una rutina)
    public function show($id) {
        $routine = Routine::with('exercises')->findOrFail($id);
        return new RoutineResource($routine);
    }

    // GET /api/routines/{id}/exercises (es público)
    public function exercises_list($id) {
        $routine = Routine::findOrFail($id);
        return response()->json($routine->exercises, 200);
    }

    // DELETE /api/my-routines/{id} (token - Desvincular usuario de rutina)
    public function destroy($id) {
        // Desasocio al usuario de la rutina en la tabla pivote routine_user
        Auth::user()->routines()->detach($id);
        return response()->json(['message' => 'Te has desuscrito de la rutina'], 200);
    }

}
