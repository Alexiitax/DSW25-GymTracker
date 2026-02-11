<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exercise_routines', function (Blueprint $table) {
            // $table->id(); aquí no usamos id, porque usamos clave primaria compuesta.

            // atributos extra del pivot
            $table->foreignId('exercise_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('routine_id')
                  ->constrained()
                  ->onDelete('cascade');
            
            // orden en el que aparece el ejercicio
            $table->integer('sequence');

            $table->integer('target_sets');
            $table->integer('target_reps');
            $table->integer('rest_seconds');

            // esta es la clave primaria compuesta
            $table->primary(['exercise_id', 'routine_id']);

            // $table->timestamps(); el ejercicio  no pide saber cuándo se añade el ejercicio.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_routines');
    }
};
