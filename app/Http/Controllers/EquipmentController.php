<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

/**
 * @group Equipment
 *
 * Equipamentos cadastrados
 */
class EquipmentController extends Controller
{
    /**
     * 
     * Listagem de equipamentos
     * 
     * Lista os equipamentos públicos cadastrados em ordem albafética
     *
     * @authenticated
     * 
     * @response {
     *   "result": true,
     *   "data": [{
     *     "id": 2,
     *     "name": "BANCO RECLINÁVEL"
     *   },
     *   {
     *     "id": 3,
     *     "name": "BOX JUMP"
     *   }]
     * }
     */
    public function index()
    {
        $dados = Equipment::orderBy('name')->get();

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

    public function show(Equipment $equipment)
    {
        //
    }

    public function edit(Equipment $equipment)
    {
        //
    }

    public function update(Request $request, Equipment $equipment)
    {
        //
    }

    public function destroy(Equipment $equipment)
    {
        //
    }
}
