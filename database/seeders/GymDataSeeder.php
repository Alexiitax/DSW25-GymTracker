<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Exercise;
use App\Models\Routine;
use App\Models\User;
use Illuminate\Database\Seeder;

class GymDataSeeder extends Seeder
{
    public function run(): void
    {
        // ================== CATEGORÍAS ==================
        $pecho = Category::firstOrCreate(['name' => 'Pecho'], ['icon_path' => 'pecho.png']);
        $espalda = Category::firstOrCreate(['name' => 'Espalda'], ['icon_path' => 'espalda.png']);
        $piernas = Category::firstOrCreate(['name' => 'Piernas'], ['icon_path' => 'piernas.png']);
        $hombros = Category::firstOrCreate(['name' => 'Hombros'], ['icon_path' => 'hombros.png']);
        $brazos = Category::firstOrCreate(['name' => 'Brazos'], ['icon_path' => 'brazos.png']);
        $core = Category::firstOrCreate(['name' => 'Core'], ['icon_path' => 'core.png']);
        $cardio = Category::firstOrCreate(['name' => 'Cardio'], ['icon_path' => 'cardio.png']);

        // ================== EJERCICIOS DE PECHO ==================
        $pressBanca = Exercise::firstOrCreate(['name' => 'Press Banca'], [
            'instruction' => 'Acuéstate en el banco, baja la barra al pecho controlando el movimiento y empuja hacia arriba.',
            'category_id' => $pecho->id
        ]);
        $pressInclinado = Exercise::firstOrCreate(['name' => 'Press Inclinado'], [
            'instruction' => 'En banco inclinado a 30-45 grados, baja la barra a la parte superior del pecho.',
            'category_id' => $pecho->id
        ]);
        $aperturas = Exercise::firstOrCreate(['name' => 'Aperturas con Mancuernas'], [
            'instruction' => 'Con mancuernas, abre los brazos en arco controlado y junta en el centro.',
            'category_id' => $pecho->id
        ]);
        $fondos = Exercise::firstOrCreate(['name' => 'Fondos en Paralelas'], [
            'instruction' => 'Baja el cuerpo flexionando los codos hasta 90 grados, inclínate ligeramente hacia adelante.',
            'category_id' => $pecho->id
        ]);
        $crossover = Exercise::firstOrCreate(['name' => 'Crossover en Polea'], [
            'instruction' => 'Con las poleas altas, cruza las manos frente al pecho apretando el pectoral.',
            'category_id' => $pecho->id
        ]);

        // ================== EJERCICIOS DE ESPALDA ==================
        $dominadas = Exercise::firstOrCreate(['name' => 'Dominadas'], [
            'instruction' => 'Agarra la barra con las palmas hacia afuera, sube hasta que la barbilla pase la barra.',
            'category_id' => $espalda->id
        ]);
        $remoConBarra = Exercise::firstOrCreate(['name' => 'Remo con Barra'], [
            'instruction' => 'Inclínate 45 grados, tira de la barra hacia el abdomen manteniendo la espalda recta.',
            'category_id' => $espalda->id
        ]);
        $jalonPolea = Exercise::firstOrCreate(['name' => 'Jalón al Pecho'], [
            'instruction' => 'Tira de la barra hacia el pecho abriendo bien los codos, controla la subida.',
            'category_id' => $espalda->id
        ]);
        $pesoMuerto = Exercise::firstOrCreate(['name' => 'Peso Muerto'], [
            'instruction' => 'Con la espalda recta, levanta la barra del suelo extendiendo caderas y rodillas.',
            'category_id' => $espalda->id
        ]);
        $facePull = Exercise::firstOrCreate(['name' => 'Face Pull'], [
            'instruction' => 'Tira de la cuerda hacia la cara abriendo los codos, aprieta los omóplatos.',
            'category_id' => $espalda->id
        ]);

        // ================== EJERCICIOS DE PIERNAS ==================
        $sentadilla = Exercise::firstOrCreate(['name' => 'Sentadilla'], [
            'instruction' => 'Con la barra en los trapecios, baja hasta que los muslos queden paralelos al suelo.',
            'category_id' => $piernas->id
        ]);
        $prensaPiernas = Exercise::firstOrCreate(['name' => 'Prensa de Piernas'], [
            'instruction' => 'Coloca los pies a la anchura de los hombros, baja la plataforma controlando el peso.',
            'category_id' => $piernas->id
        ]);
        $extension = Exercise::firstOrCreate(['name' => 'Extensión de Cuádriceps'], [
            'instruction' => 'Sentado en la máquina, extiende las piernas completamente apretando los cuádriceps.',
            'category_id' => $piernas->id
        ]);
        $curlFemoral = Exercise::firstOrCreate(['name' => 'Curl Femoral'], [
            'instruction' => 'Tumbado boca abajo, flexiona las piernas llevando los talones hacia los glúteos.',
            'category_id' => $piernas->id
        ]);
        $zancadas = Exercise::firstOrCreate(['name' => 'Zancadas'], [
            'instruction' => 'Da un paso adelante y baja la rodilla trasera casi hasta el suelo, alterna piernas.',
            'category_id' => $piernas->id
        ]);
        $hipThrust = Exercise::firstOrCreate(['name' => 'Hip Thrust'], [
            'instruction' => 'Apoya la espalda en un banco, sube las caderas apretando los glúteos arriba.',
            'category_id' => $piernas->id
        ]);

        // ================== EJERCICIOS DE HOMBROS ==================
        $pressMilitar = Exercise::firstOrCreate(['name' => 'Press Militar'], [
            'instruction' => 'De pie o sentado, empuja la barra desde los hombros hacia arriba.',
            'category_id' => $hombros->id
        ]);
        $elevacionesLaterales = Exercise::firstOrCreate(['name' => 'Elevaciones Laterales'], [
            'instruction' => 'Con mancuernas, eleva los brazos a los lados hasta la altura de los hombros.',
            'category_id' => $hombros->id
        ]);
        $pajaros = Exercise::firstOrCreate(['name' => 'Pájaros'], [
            'instruction' => 'Inclinado hacia adelante, eleva los brazos a los lados trabajando el deltoides posterior.',
            'category_id' => $hombros->id
        ]);
        $elevacionesFrontales = Exercise::firstOrCreate(['name' => 'Elevaciones Frontales'], [
            'instruction' => 'Con mancuernas, eleva los brazos al frente hasta la altura de los ojos.',
            'category_id' => $hombros->id
        ]);

        // ================== EJERCICIOS DE BRAZOS ==================
        $curlBiceps = Exercise::firstOrCreate(['name' => 'Curl de Bíceps'], [
            'instruction' => 'Con mancuernas o barra, flexiona los codos manteniendo los codos pegados al cuerpo.',
            'category_id' => $brazos->id
        ]);
        $curlMartillo = Exercise::firstOrCreate(['name' => 'Curl Martillo'], [
            'instruction' => 'Con las palmas mirándose, flexiona los codos subiendo las mancuernas.',
            'category_id' => $brazos->id
        ]);
        $tricepsFrances = Exercise::firstOrCreate(['name' => 'Extensión de Tríceps'], [
            'instruction' => 'Con mancuerna o barra, extiende los brazos por encima de la cabeza.',
            'category_id' => $brazos->id
        ]);
        $tricepsPolea = Exercise::firstOrCreate(['name' => 'Tríceps en Polea'], [
            'instruction' => 'Con la polea alta, extiende los brazos hacia abajo manteniendo los codos fijos.',
            'category_id' => $brazos->id
        ]);
        $fondosTriceps = Exercise::firstOrCreate(['name' => 'Fondos en Banco'], [
            'instruction' => 'Apoya las manos en un banco detrás, baja el cuerpo flexionando los codos.',
            'category_id' => $brazos->id
        ]);

        // ================== EJERCICIOS DE CORE ==================
        $plancha = Exercise::firstOrCreate(['name' => 'Plancha'], [
            'instruction' => 'Mantén el cuerpo recto apoyado en antebrazos y puntas de los pies.',
            'category_id' => $core->id
        ]);
        $crunch = Exercise::firstOrCreate(['name' => 'Crunch Abdominal'], [
            'instruction' => 'Tumbado boca arriba, eleva los hombros del suelo contrayendo el abdomen.',
            'category_id' => $core->id
        ]);
        $russian = Exercise::firstOrCreate(['name' => 'Russian Twist'], [
            'instruction' => 'Sentado, inclínate hacia atrás y gira el torso de lado a lado con peso.',
            'category_id' => $core->id
        ]);
        $legRaise = Exercise::firstOrCreate(['name' => 'Elevación de Piernas'], [
            'instruction' => 'Colgado de una barra, eleva las piernas rectas hasta la horizontal.',
            'category_id' => $core->id
        ]);

        // ================== EJERCICIOS DE CARDIO ==================
        $cinta = Exercise::firstOrCreate(['name' => 'Cinta de Correr'], [
            'instruction' => 'Corre a intensidad moderada manteniendo el ritmo cardíaco elevado.',
            'category_id' => $cardio->id
        ]);
        $bicicleta = Exercise::firstOrCreate(['name' => 'Bicicleta Estática'], [
            'instruction' => 'Pedalea a intensidad moderada-alta, ajusta la resistencia según tu nivel.',
            'category_id' => $cardio->id
        ]);
        $eliptica = Exercise::firstOrCreate(['name' => 'Elíptica'], [
            'instruction' => 'Movimiento fluido de piernas y brazos, bajo impacto articular.',
            'category_id' => $cardio->id
        ]);
        $remo = Exercise::firstOrCreate(['name' => 'Máquina de Remo'], [
            'instruction' => 'Tira del mango hacia el pecho empujando con las piernas primero.',
            'category_id' => $cardio->id
        ]);

        // ================== RUTINAS ==================
        // Rutina Push Day
        $pushDay = Routine::firstOrCreate(
            ['name' => 'Push Day'], 
            ['description' => 'Día de empuje: pecho, hombros y tríceps. Ideal para lunes.']
        );
        $pushDay->exercises()->sync([
            $pressBanca->id => ['sequence' => 1, 'target_sets' => 4, 'target_reps' => 10, 'rest_seconds' => 90],
            $pressInclinado->id => ['sequence' => 2, 'target_sets' => 3, 'target_reps' => 12, 'rest_seconds' => 60],
            $aperturas->id => ['sequence' => 3, 'target_sets' => 3, 'target_reps' => 15, 'rest_seconds' => 60],
            $pressMilitar->id => ['sequence' => 4, 'target_sets' => 4, 'target_reps' => 10, 'rest_seconds' => 90],
            $elevacionesLaterales->id => ['sequence' => 5, 'target_sets' => 3, 'target_reps' => 15, 'rest_seconds' => 45],
            $tricepsPolea->id => ['sequence' => 6, 'target_sets' => 3, 'target_reps' => 12, 'rest_seconds' => 45],
        ]);

        // Rutina Pull Day
        $pullDay = Routine::firstOrCreate(
            ['name' => 'Pull Day'], 
            ['description' => 'Día de tirón: espalda y bíceps. Perfecto para miércoles.']
        );
        $pullDay->exercises()->sync([
            $dominadas->id => ['sequence' => 1, 'target_sets' => 4, 'target_reps' => 8, 'rest_seconds' => 120],
            $remoConBarra->id => ['sequence' => 2, 'target_sets' => 4, 'target_reps' => 10, 'rest_seconds' => 90],
            $jalonPolea->id => ['sequence' => 3, 'target_sets' => 3, 'target_reps' => 12, 'rest_seconds' => 60],
            $facePull->id => ['sequence' => 4, 'target_sets' => 3, 'target_reps' => 15, 'rest_seconds' => 45],
            $curlBiceps->id => ['sequence' => 5, 'target_sets' => 3, 'target_reps' => 12, 'rest_seconds' => 60],
            $curlMartillo->id => ['sequence' => 6, 'target_sets' => 3, 'target_reps' => 12, 'rest_seconds' => 45],
        ]);

        // Rutina Leg Day
        $legDay = Routine::firstOrCreate(
            ['name' => 'Leg Day'], 
            ['description' => 'Día de piernas completo: cuádriceps, isquios y glúteos.']
        );
        $legDay->exercises()->sync([
            $sentadilla->id => ['sequence' => 1, 'target_sets' => 4, 'target_reps' => 8, 'rest_seconds' => 120],
            $prensaPiernas->id => ['sequence' => 2, 'target_sets' => 4, 'target_reps' => 12, 'rest_seconds' => 90],
            $zancadas->id => ['sequence' => 3, 'target_sets' => 3, 'target_reps' => 10, 'rest_seconds' => 60],
            $extension->id => ['sequence' => 4, 'target_sets' => 3, 'target_reps' => 15, 'rest_seconds' => 45],
            $curlFemoral->id => ['sequence' => 5, 'target_sets' => 3, 'target_reps' => 12, 'rest_seconds' => 45],
            $hipThrust->id => ['sequence' => 6, 'target_sets' => 4, 'target_reps' => 12, 'rest_seconds' => 60],
        ]);

        // Rutina Full Body
        $fullBody = Routine::firstOrCreate(
            ['name' => 'Full Body'], 
            ['description' => 'Rutina de cuerpo completo para principiantes o días con poco tiempo.']
        );
        $fullBody->exercises()->sync([
            $sentadilla->id => ['sequence' => 1, 'target_sets' => 3, 'target_reps' => 10, 'rest_seconds' => 90],
            $pressBanca->id => ['sequence' => 2, 'target_sets' => 3, 'target_reps' => 10, 'rest_seconds' => 90],
            $remoConBarra->id => ['sequence' => 3, 'target_sets' => 3, 'target_reps' => 10, 'rest_seconds' => 90],
            $pressMilitar->id => ['sequence' => 4, 'target_sets' => 3, 'target_reps' => 10, 'rest_seconds' => 60],
            $plancha->id => ['sequence' => 5, 'target_sets' => 3, 'target_reps' => 30, 'rest_seconds' => 45],
        ]);

        // Rutina de Core
        $coreWorkout = Routine::firstOrCreate(
            ['name' => 'Core Blast'], 
            ['description' => 'Rutina intensa de abdominales y core. 20 minutos.']
        );
        $coreWorkout->exercises()->sync([
            $plancha->id => ['sequence' => 1, 'target_sets' => 3, 'target_reps' => 45, 'rest_seconds' => 30],
            $crunch->id => ['sequence' => 2, 'target_sets' => 3, 'target_reps' => 20, 'rest_seconds' => 30],
            $russian->id => ['sequence' => 3, 'target_sets' => 3, 'target_reps' => 20, 'rest_seconds' => 30],
            $legRaise->id => ['sequence' => 4, 'target_sets' => 3, 'target_reps' => 15, 'rest_seconds' => 30],
        ]);

        // Rutina Cardio HIIT
        $hiit = Routine::firstOrCreate(
            ['name' => 'HIIT Cardio'], 
            ['description' => 'Entrenamiento de intervalos de alta intensidad. Quema grasa.']
        );
        $hiit->exercises()->sync([
            $cinta->id => ['sequence' => 1, 'target_sets' => 5, 'target_reps' => 1, 'rest_seconds' => 60],
            $bicicleta->id => ['sequence' => 2, 'target_sets' => 5, 'target_reps' => 1, 'rest_seconds' => 60],
            $eliptica->id => ['sequence' => 3, 'target_sets' => 5, 'target_reps' => 1, 'rest_seconds' => 60],
            $remo->id => ['sequence' => 4, 'target_sets' => 5, 'target_reps' => 1, 'rest_seconds' => 60],
        ]);

        echo "Datos del gimnasio creados correctamente!\n";
    }
}
