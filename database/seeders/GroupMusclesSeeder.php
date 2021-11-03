<?php

namespace Database\Seeders;

use App\Models\MuscleGroup;
use Illuminate\Database\Seeder;

class GroupMusclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MuscleGroup::create(['name' => 'DELTÓIDE']);
        MuscleGroup::create(['name' => 'BÍCEPS']);
        MuscleGroup::create(['name' => 'TRÍCEPS']);
        MuscleGroup::create(['name' => 'PEITORAL']);
        MuscleGroup::create(['name' => 'OBLÍQUOS']);
        MuscleGroup::create(['name' => 'ABDOMINAL']);
        MuscleGroup::create(['name' => 'QUADRÍCEPS']);
        MuscleGroup::create(['name' => 'TRAPÉZIO']);
        MuscleGroup::create(['name' => 'GLÚTEO']);
        MuscleGroup::create(['name' => 'PANTURRILHA']);
    }
}
