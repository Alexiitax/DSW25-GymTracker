<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoutineRequest;
use App\Http\Resources\RoutineResource;
use App\Models\Routine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoutineController extends Controller
{
    // GET api/my-routines - Rutinas del usuario autenticado
    public function index()
    {
        $user = Auth::user();
        $routines = $user->routines()->with('exercises')->get();
        return RoutineResource::collection($routines);
    }

    // POST api/routines - Crear nueva rutina
    public function store(StoreRoutineRequest $request)
    {
        $routine = Routine::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        Auth::user()->routines()->attach($routine->id);

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

        return new RoutineResource($routine->load('exercises'));
    }

    // POST api/my-routines - Suscribirse a una rutina existente
    public function subscribe(Request $request)
    {
        $request->validate([
            'routine_id' => 'required|exists:routines,id'
        ]);

        $user = Auth::user();
        
        if ($user->routines()->where('routine_id', $request->routine_id)->exists()) {
            return response()->json(['message' => 'Ya estas suscrito a esta rutina'], 409);
        }

        $user->routines()->attach($request->routine_id);

        return response()->json(['message' => 'Te has suscrito a la rutina'], 201);
    }

    // GET api/routines - Todas las rutinas publicas
    public function index_public()
    {
        return RoutineResource::collection(Routine::with('exercises')->get());
    }

    // GET api/routines/{id} - Detalle de una rutina
    public function show($id)
    {
        $routine = Routine::with('exercises')->findOrFail($id);
        return new RoutineResource($routine);
    }

    // GET api/routines/{id}/exercises
    public function exercises_list($id)
    {
        $routine = Routine::findOrFail($id);
        return response()->json($routine->exercises, 200);
    }

    // DELETE api/my-routines/{id} - Desuscribirse de una rutina
    public function destroy($id)
    {
        Auth::user()->routines()->detach($id);
        return response()->json(['message' => 'Te has desuscrito de la rutina'], 200);
    }

    // PUT api/routines/{id} - Editar rutina
    public function update(Request $request, $id)
    {
        $routine = Routine::findOrFail($id);
        $routine->update($request->only(['name', 'description']));
        return new RoutineResource($routine);
    }

    // DELETE api/routines/{id} - Borrar rutina completamente
    public function deleteFullRoutine($id)
    {
        $routine = Routine::findOrFail($id);
        $routine->delete();
        return response()->json(['message' => 'Rutina eliminada del sistema'], 200);
    }

    // POST api/routines/{id}/exercises - Anadir ejercicio a rutina
    public function addExercise(Request $request, $id)
    {
        $routine = Routine::findOrFail($id);
        $routine->exercises()->attach($request->exercise_id, [
            'target_reps' => $request->reps,
            'target_sets' => $request->sets,
            'rest_seconds' => $request->rest ?? 60,
            'sequence' => $request->sequence ?? 1
        ]);
        return response()->json(['message' => 'Ejercicio anadido correctamente.'], 200);
    }

    // DELETE api/routines/{id}/exercises/{e_id} - Quitar ejercicio de rutina
    public function removeExercise($id, $e_id)
    {
        $routine = Routine::findOrFail($id);
        $routine->exercises()->detach($e_id);
        return response()->json(['message' => 'Ejercicio quitado de la rutina.']);
    }
}
