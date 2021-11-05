<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Equipment::create(['name' => "BANCO SUPINO"]);
        Equipment::create(['name' => "BANCO RECLINÁVEL"]);
        Equipment::create(['name' => "BOX JUMP"]);
        Equipment::create(['name' => "CORDA"]);
        Equipment::create(['name' => "NENHUM"]);
    }
}
