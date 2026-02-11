<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    protected $fillable = ['name', 'description'];

    // esta es la relación N:M con ejercicios.
    public function exercises() {
        return $this->belongsToMany(Exercise::class)
                    // el pivot lo uso para indicar que quiero acceder a estos campos extra.
                    ->withPivot('sequence', 'target_sets', 'target_reps', 'rest_seconds');
    }

    // esta es la relación N:M con los usuarios.
    public function users() {
        return $this->belongsToMany(User::class);
    }
}
