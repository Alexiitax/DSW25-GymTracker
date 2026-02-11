<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoutineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'exercises' => 'required|array|min:1', // No puede estar vacío
            'exercises.*.exercise_id' => 'required|exists:exercises,id', // El ID debe existir en la tabla exercises
            'exercises.*.sequence' => 'required|integer',
            'exercises.*.target_sets' => 'required|integer',
            'exercises.*.target_reps' => 'required|integer',
            'exercises.*.rest_seconds' => 'required|integer',
        ];
    }
}
