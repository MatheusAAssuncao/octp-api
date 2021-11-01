<?php

namespace App\Http\Controllers;

use App\Models\MuscleGroup;
use Illuminate\Http\Request;

/**
 * @group Muscle-Groups
 *
 * Grupos musculares cadastrados
 */
class MuscleGroupController extends Controller
{
    /**
     * 
     * Listagem de grupos musculares
     * 
     * Lista os grupos musculares públicos cadastrados em ordem albafética
     *
     * @authenticated
     * 
     * @response {
     *   "result": true,
     *   "data": [{
     *     "id": 6,
     *     "name": "ABDOMINAL"
     *   },
     *   {
     *     "id": 2,
     *     "name": "BÍCEPS"
     *   }]
     * }
     */
    public function index()
    {
        $dados = MuscleGroup::orderBy('name')->get();

        return response()->json(['result' => true, 'data' => $dados]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(MuscleGroup $muscleGroup)
    {
        //
    }

    public function edit(MuscleGroup $muscleGroup)
    {
        //
    }

    public function update(Request $request, MuscleGroup $muscleGroup)
    {
        //
    }

    public function destroy(MuscleGroup $muscleGroup)
    {
        //
    }
}
