<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoutineRequest;
use App\Http\Resources\RoutineResource;
use App\Models\Routine; // Para la validación, punto B
use Illuminate\Http\Request; // Para el formato JSON, punto A
use Illuminate\Support\Facades\Auth;

class RoutineController extends Controller
{
    // Este es el GET api/routines
    public function index()
    {

        // obtenener el usuario autenticado
        $user = Auth::user();

        // acceder a las rutinas a través de la relación.
        // cargar también los ejercicios para una respuesta completa.
        $routines = $user->routines()->with('exercises')->get();

        // A; uso el resource para devolver los datos con el formato
        return RoutineResource::collection($routines);
    }

    // Este es el POST api/routines
    // cambio request por storeroutinerequest
    public function store(StoreRoutineRequest $request)
    {
        // Creo la rutina en la tabla 'routines'
        $routine = Routine::create([
            'name' => $request->name, 
            'description' => $request->description,
        ]);

        // Asocio la rutina al usuario autenticado (Tabla routine_user)
        Auth::user()->routines()->attach($routine->id);

        // Reviso SI VIENEN EJERCICIOS 
        if ($request->has('exercises') && is_array($request->exercises)) {
            foreach ($request->exercises as $ex) {
                $routine->exercises()->attach($ex['exercise_id'], [
                    'sequence' => $ex['sequence'] ?? 1,
                    'target_sets' => $ex['target_sets'],
                    'target_reps' => $ex['target_reps'],
                    'rest_seconds' => $ex['rest_seconds'],
                ]);
            }
        }

        // Cargo las relaciones antes de devolver el Resource para que no vaya vacío
        return new RoutineResource($routine->load('exercises'));
    }

    // GET /api/routines (es público - Todas las rutinas del sistema)
    public function index_public()
    {
        return RoutineResource::collection(Routine::all());
    }

    // GET /api/routines/{id} (es público - Detalle de una rutina)
    public function show($id)
    {
        $routine = Routine::with('exercises')->findOrFail($id);

        return new RoutineResource($routine);
    }

    // GET /api/routines/{id}/exercises (es público)
    public function exercises_list($id)
    {
        $routine = Routine::findOrFail($id);

        return response()->json($routine->exercises, 200);
    }

    // DELETE /api/my-routines/{id} (token - Desvincular usuario de rutina)
    // public function destroy($id)
    // {
    //     // Desasocio al usuario de la rutina en la tabla pivote routine_user
    //     Auth::user()->routines()->detach($id);

    //     return response()->json(['message' => 'Te has desuscrito de la rutina'], 200);
    // }

    // Edito el nombre o la descripción
    public function update(Request $request, $id) {
        $routine = Routine::findOrFail($id);
        // Actualizo solo los campos que envíe en el JSON
        $routine->update($request->only(['name', 'description']));
    }

    // Borro la rutina de la base de datos
    public function deleteFullRoutine($id) {
        $routine = Routine::findOrFail($id);
        $routine->delete();
        return response()->json(['message' => 'Rutina eliminada del sistema'], 200);
    }

    public function addExercise(Request $request, $id) {
        $routine = Routine::findOrFail($id);

        //El 'attach' es el que se encarga de rellenar la tabla pivot exercise_routine
        $routine->exercise()-attach($request->exercise_id, [
            'target_reps' => $request->reps,
            'target_sets' => $request->sets,
            'rest_seconds' => $request->rest ?? 60,
            'sequence' => $request->sequence ?? 1
        ]);

        return response()->json(['message' => 'Ejercicio añadido correctamente.'], 200);

    }

    // Quito un ejercicio de la rutina
    public function removeExercise($id, $e_id) {
        $routine = Routine::findOrFail($id);
        // 'detach' borra la fila en la tabla intermedia
        $routine->exercises()->detach($e_id);
        return response()->json(['message' => 'Ejercicio quitado de la rutina.']);
    }

}
