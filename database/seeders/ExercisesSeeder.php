<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\Exercise;
use App\Models\MuscleGroup;
use Illuminate\Database\Seeder;

class ExercisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Exercise::create([
            'name' => 'SUPINO RETO',
            'id_muscle_group' => (MuscleGroup::where('name', 'PEITORAL')->select(['id'])->get())[0]->id,
            'id_equipment' => (Equipment::where('name', 'BANCO SUPINO')->select(['id'])->get())[0]->id
        ]);

        Exercise::create([
            'name' => 'CRUCIFIXO INCLINADO',
            'id_muscle_group' => (MuscleGroup::where('name', 'PEITORAL')->select(['id'])->get())[0]->id,
            'id_equipment' => (Equipment::where('name', 'BANCO RECLINÁVEL')->select(['id'])->get())[0]->id
        ]);

        Exercise::create([
            'name' => 'CROSS OVER',
            'id_muscle_group' => (MuscleGroup::where('name', 'PEITORAL')->select(['id'])->get())[0]->id,
            'id_equipment' => (Equipment::where('name', 'BANCO SUPINO')->select(['id'])->get())[0]->id
        ]);

        Exercise::create([
            'name' => 'SUPINO FECHADO',
            'id_muscle_group' => (MuscleGroup::where('name', 'PEITORAL')->select(['id'])->get())[0]->id,
            'id_equipment' => (Equipment::where('name', 'BANCO SUPINO')->select(['id'])->get())[0]->id
        ]);

        Exercise::create([
            'name' => 'TRÍCEPS PULLEY UNILATERAL',
            'id_muscle_group' => (MuscleGroup::where('name', 'TRÍCEPS')->select(['id'])->get())[0]->id,
            'id_equipment' => (Equipment::where('name', 'CORDA')->select(['id'])->get())[0]->id
        ]);

        Exercise::create([
            'name' => 'CABLE CRUNCK',
            'id_muscle_group' => (MuscleGroup::where('name', 'TRÍCEPS')->select(['id'])->get())[0]->id,
            'id_equipment' => (Equipment::where('name', 'CORDA')->select(['id'])->get())[0]->id
        ]);

        Exercise::create([
            'name' => 'INFRA',
            'id_muscle_group' => (MuscleGroup::where('name', 'PANTURRILHA')->select(['id'])->get())[0]->id,
            'id_equipment' => (Equipment::where('name', 'NENHUM')->select(['id'])->get())[0]->id
        ]);
    }
}
