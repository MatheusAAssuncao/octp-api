<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\ExerciseDetail;
use App\Models\ExerciseGroup;
use Illuminate\Http\Request;

/**
 * @group Exercise
 *
 * Gerenciamento de exercícios
 */
class ExerciseController extends Controller
{
    /**
     * 
     * Listagem de exercícios
     * 
     * Lista os exercícios públicos e privados (cadastrados pelo usuário)
     *
     * @authenticated
     * 
     * @response {
     *   "result": true,
     *   "data": [{
     *      "id": 1,
     *      "name": "SUPINO RETO",
     *      "description": null,
     *      "url": null,
     *      "public": true,
     *      "muscle_group": {
     *        "id": 4,
     *        "name": "PEITORAL"
     *      },
     *      "equipment": {
     *        "id": 1,
     *        "name": "BANCO SUPINO"
     *   }]
     * }
     */
    public function index()
    {
        $user = auth('api')->user();
        $_exercises = Exercise::where(function ($query) use ($user) {
            $query->where('id_user', $user->id)->orWhere('id_user', null);
        })->get();

        $dados = array();

        foreach ($_exercises as $_exercise) {
            $dados[] = array(
                "id" => $_exercise->id,
                "name" => $_exercise->name,
                "description" => $_exercise->description,
                "url" => $_exercise->url,
                "public" => !is_numeric($_exercise->id_user),
                "muscle_group" => $_exercise->musclegroup,
                "equipment" => $_exercise->equipment
            );
        }

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

    public function show(Exercise $exercise)
    {
        //
    }

    public function edit(Exercise $exercise)
    {
        //
    }

    public function update(Request $request, Exercise $exercise)
    {
        //
    }

    public function destroy(Exercise $exercise)
    {
        //
    }

    /**
     * 
     * Listagem de tipos de exercícios
     * 
     * Lista as grupos de exercícios possíveis
     *
     * @authenticated
     * 
     * @response {
     *   "result": true,
     *   "data": [
     *     "TRADICIONAL", "BI-SET", "TRI-SET", "DROP-SET", "TEXTO LIVRE"
     *   ]
     * }
     */
    public function showGroupType()
    {
        return response()->json(['result' => true, 'data' => ExerciseGroup::$groupTypes]);
    }

    /**
     * 
     * Listagem de tipos de repetições
     * 
     * Lista os tipos de repetições para os exercícios
     *
     * @authenticated
     * 
     * @response {
     *   "result": true,
     *   "data": [
     *     "REPETIÇÕES", "MINUTOS", "SEGUNDOS"
     *   ]
     * }
     */
    public function showRepetitionType()
    {
        return response()->json(['result' => true, 'data' => ExerciseDetail::$repetitionTypes]);
    }

    /**
     * 
     * Listagem de tipos de pesos
     * 
     * Lista os tipos de pesos a serem usados nos exercícios
     *
     * @authenticated
     * 
     * @response {
     *   "result": true,
     *   "data": [
     *     "KILO", "LIBRA", "PESO", "POR CENTO"
     *   ]
     * }
     */
    public function showChargeType()
    {
        return response()->json(['result' => true, 'data' => ExerciseDetail::$chargeTypes]);
    }
}
