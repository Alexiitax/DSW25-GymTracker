<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoutineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // El usuario autenticado puede crear rutinas
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'exercises' => 'required|array|min:1',
            'exercises.*.exercise_id' => 'required|exists:exercises,id',
            'exercises.*.sequence' => 'required|integer',
            'exercises.*.target_sets' => 'required|integer',
            'exercises.*.target_reps' => 'required|integer',
            'exercises.*.rest_seconds' => 'required|integer',
        ];
    }
}
