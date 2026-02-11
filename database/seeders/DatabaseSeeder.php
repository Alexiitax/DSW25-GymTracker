<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Exercise;
use App\Models\Routine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Creo un usuario especifico para las pruebas
        // Uso el updateOrCreate para que, al correrlo varias veces no de errores de duplicados
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password123'), 
            ]
        );

        // Creo un par de categorias de prueba
        $fuerza = Category::create(['name' => 'Fuerza', 'icon_path' => 'fuerza.png']);
        $cardio = Category::create(['name' => 'Cardio', 'icon_path' => 'cardio.png']);

        // Creo un par de ejercicios de prueba
        Exercise::create([
            'name' => 'Press Banca',
            'instruction' => 'Ejercicio básico de pecho con barra.',
            'category_id' => $fuerza->id
        ]);

        Exercise::create([
            'name' => 'Sentadilla Búlgara',
            'instruction' => 'Ejercicio de pierna, con pierna apoyada en un banquillo.',
            'category_id' => $fuerza->id
        ]);

        Exercise::create([
            'name' => 'Cinta de Correr',
            'instruction' => 'Correr a intensidad moderada.',
            'category_id' => $cardio->id
        ]);

        // Con esto creo unos cuantos usuarios aleatorios para hacer pruebas tambien
        User::factory(5)->create();
    }
}
