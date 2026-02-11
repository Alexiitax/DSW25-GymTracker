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
}
