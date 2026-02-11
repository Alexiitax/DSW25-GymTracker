<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoutineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    // con esta funcion los datos de la tabla pivote no se quedan escondidos
    // dentro de un objeto pivot, si no que se quedan al mismo nivel que el ejercicio.
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'exercises' => $this->exercises->map(function ($exercise) {
                return [
                    'id' => $exercise->id,
                    'name' => $exercise->name,
                    'instruction' => $exercise->instruction,
                    // Ponemos los datos del pivot al mismo nivel:
                    'sequence' => $exercise->pivot->sequence,
                    'target_sets' => $exercise->pivot->target_sets,
                    'target_reps' => $exercise->pivot->target_reps,
                    'rest_seconds' => $exercise->pivot->rest_seconds,
                ];
            }),
        ];
    }
}
