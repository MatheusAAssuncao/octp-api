<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\ExerciseDetail;
use App\Models\ExerciseGroup;
use App\Models\ExerciseSerie;
use App\Models\TeacherStudent;
use App\Models\Train;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PHPUnit\TextUI\XmlConfiguration\Group;

/**
 * @group Train
 *
 * Gerenciamento de treinos
 */
class TrainController extends Controller
{
    public function index()
    {
        //
    }

    /**
     * 
     * Adiciona um treino
     * 
     * Cadastra um treino a um ID de ficha existente. Exemplo de JSON na requisição:
     * {
     *        "id_card": 1,
     *        "name": "A",
     *        "break": 120,
     *        "exercise_groups": [
     *            {
     *                "type": "TRADICIONAL",
     *                "order": 1,
     *                "detail": [
     *                    {
     *                        "id_exercise": 1,
     *                        "id_equipment": 1,
     *                        "url": null,
     *                        "repetition_type": "REPETIÇÕES",
     *                        "charge_type": "KILO",
     *                        "series_interval": 60,
     *                        "notes": null,
     *                        "series": [
     *                            {
     *                                "charge": 30,
     *                                "repetition": 12,
     *                                "order": 1
     *                            },
     *                            {
     *                                "charge": 30,
     *                                "repetition": 12,
     *                                "order": 2
     *                            },
     *                            {
     *                                "charge": 30,
     *                                "repetition": 12,
     *                                "order": 3
     *                            },
     *                            {
     *                                "charge": 30,
     *                                "repetition": 12,
     *                                "order": 4
     *                            }
     *                        ]
     *                    }
     *                ]
     *            },
     *            {
     *                "type": "BI-SET",
     *                "order": 2,
     *                "detail": [
     *                    {
     *                        "id_exercise": 2,
     *                        "id_equipment": 1,
     *                        "url": null,
     *                        "repetition_type": "REPETIÇÕES",
     *                        "charge_type": "KILO",
     *                        "series_interval": 60,
     *                        "notes": null,
     *                        "series": [
     *                            {
     *                                "charge": 30,
     *                                "repetition": 12,
     *                                "order": 1
     *                            },
     *                            {
     *                                "charge": 30,
     *                                "repetition": 12,
     *                                "order": 2
     *                            },
     *                            {
     *                                "charge": 30,
     *                                "repetition": 12,
     *                                "order": 3
     *                            },
     *                            {
     *                                "charge": 30,
     *                                "repetition": 12,
     *                                "order": 4
     *                            }
     *                        ]
     *                    },
     *                    {
     *                        "id_exercise": 3,
     *                        "id_equipment": 1,
     *                        "url": null,
     *                        "repetition_type": "REPETIÇÕES",
     *                        "charge_type": "KILO",
     *                        "series_interval": 60,
     *                        "notes": null,
     *                        "series": [
     *                            {
     *                                "charge": 30,
     *                                "repetition": 12,
     *                                "order": 1
     *                            },
     *                            {
     *                                "charge": 30,
     *                                "repetition": 12,
     *                                "order": 2
     *                            },
     *                            {
     *                                "charge": 30,
     *                                "repetition": 12,
     *                                "order": 3
     *                            },
     *                            {
     *                                "charge": 30,
     *                                "repetition": 12,
     *                                "order": 4
     *                            }
     *                        ]
     *                    }
     *                ]
     *            }
     *        ]
     *    }
     *
     * @authenticated
     * 
     * @bodyParam  id_card integer required ID da ficha. Example: 123
     * @bodyParam  name string required Nome do treino. Example: A
     * @bodyParam  break integer required Tempo em segundos para descanso entre exercícios. Example: 120
     * @bodyParam  exercise_groups array required Array de objetos JSON que conterá os exercícios 
     * @bodyParam  exercise_groups.type string required Tipos de grupos de exercícios. Ver em exercise/group-type Example: BI-SET
     * @bodyParam  exercise_groups.order required integer Ordenação dos exercícios. Example: 1
     * @bodyParam  exercise_groups.detail array required Array de objetos JSON com os detalhes do(s) exercício(s).
     * @bodyParam  exercise_groups.detail.id_exercise integer required ID do exercício. Example: 10
     * @bodyParam  exercise_groups.detail.id_equipment integer required ID do equipamento. Example: 2
     * @bodyParam  exercise_groups.detail.url string URL do vídeo exemplo. Example: https://youtub/*e.com.br/Hkh6RF2F1
     * @bodyParam  exercise_groups.detail.repetition_type string required Tipo das repetições. Ver em exercise/repetition-type. Example: REPETIÇÕES
     * @bodyParam  exercise_groups.detail.charge_type string required Tipo de peso utilizado. Ver em exercise/charge-type. Example: KILO
     * @bodyParam  exercise_groups.detail.series_interval integer required Array de objetos JSON com os detalhes do(s) exercício(s).
     * @bodyParam  exercise_groups.detail.notes string Observações opcionais. Example: Executar até a falha
     * @bodyParam  exercise_groups.detail.series array required Array de objetos JSON com os detalhes da series.
     * @bodyParam  exercise_groups.detail.charge integer required Numéro do peso recomendado. Example: 20
     * @bodyParam  exercise_groups.detail.repetition integer required Número de repetições da serie. Example: 12
     * @bodyParam  exercise_groups.detail.order integer required Ordenação das repetições. Example: 1
     * 
     * @response {
     *   "result": true,
     *   "data": {
     *   },
     *   "message": "Mensagem de erro se houver"
     * }
     */
    public function create(Request $request)
    {
        $_teacher = auth('api')->user();
        if (!$_teacher->isTeacher()) {
            abort(404);
        }

        $validation = Validator::make($request->all(), [
            'id_card' => 'required|integer|exists:App\Models\Card,id',
            'name' => 'required|min:1|max:45',
            'break' => 'required|integer',
            'exercise_groups' => 'required|array',
            'exercise_groups.*.type' => 'required|in:'.implode(",", ExerciseGroup::$groupTypes),
            'exercise_groups.*.order' => 'required|integer',
            'exercise_groups.*.detail' => 'required|array',
            'exercise_groups.*.detail.*.id_exercise' => 'required|integer|exists:App\Models\Exercise,id',
            'exercise_groups.*.detail.*.id_equipment' => 'required|integer|exists:App\Models\Equipment,id',
            'exercise_groups.*.detail.*.url' => 'nullable|url',
            'exercise_groups.*.detail.*.repetition_type' => 'required|in:'.implode(",", ExerciseDetail::$repetitionTypes),
            'exercise_groups.*.detail.*.charge_type' => 'required|in:'.implode(",", ExerciseDetail::$chargeTypes),
            'exercise_groups.*.detail.*.series_interval' => 'required|integer',
            'exercise_groups.*.detail.*.notes' => 'nullable|max:250',
            'exercise_groups.*.detail.*.series' => 'required|array',
            'exercise_groups.*.detail.*.series.*.charge' => 'required|integer',
            'exercise_groups.*.detail.*.series.*.repetition' => 'required|integer',
            'exercise_groups.*.detail.*.series.*.order' => 'required|integer',
        ]);

        if ($validation->fails()) {
            return response()->json(['result' => false, 'message' => "Campos incorretos!", 'data' => $validation->errors()]);
        }

        try {
            DB::transaction(function() use ($request) {
                $_trains = Train::where('id_card', $request->input('id_card'))
                    ->where('name', $request->input('name'))
                    ->get();
                foreach ($_trains as $_train) {
                    $_train->delete();
                }

                $_train = Train::create([
                    'name' => $request->input('name'),
                    'break' => $request->input('break'),
                    'id_card' => $request->input('id_card')
                ]);
                
                foreach ($request->input('exercise_groups') as $group) {
                    $_group = ExerciseGroup::create([
                        'type' => $group['type'],
                        'id_train' => $_train->id,
                        'order' => $group['order']
                    ]);
    
                    foreach ($group['detail'] as $detail) {
                        $_detail = ExerciseDetail::create([
                            'id_exercise' => $detail['id_exercise'],
                            'id_exercise_group' => $_group->id,
                            'id_equipment' => $detail['id_equipment'],
                            'url' => $detail['url'],
                            'repetition_type' => $detail['repetition_type'],
                            'charge_type' => $detail['charge_type'],
                            'series_interval' => $detail['series_interval'],
                            'notes' => $detail['notes'],
                        ]);
    
                        foreach ($detail['series'] as $serie) {
                            ExerciseSerie::create([
                                'id_exercise_detail' => $_detail->id,
                                'charge' => $serie['charge'],
                                'repetition' => $serie['repetition'],
                                'order' => $serie['order'],
                            ]);
                        }
                    }
                }
            });

            return response()->json(['result' => true, 'data' => $request->all()]);

        } catch(Exception $ex) {
            return response()->json([
                'result' => false, 
                'message' => "Erro ao inserir novo treino!", 
                'ex' => $ex->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Train $train)
    {
        //
    }

    public function edit(Train $train)
    {
        //
    }

    public function update(Request $request, Train $train)
    {
        //
    }

    /**
     * 
     * Remover treino
     * 
     * Remove um treino da base de dados. Apenas usuário professor no qual o aluno seja seu.
     *
     * @authenticated
     * 
     * @queryParam id required O ID do treino a ser removido. 
     * 
     * @response {
     *   "result": true,
     *   "message": "Treino removido com sucesso!"
     * }
     */
    public function destroy($id)
    {
        $_teacher = auth('api')->user();
        if (!$_teacher->isTeacher()) {
            abort(404);
        }

        try {

            $_train = Train::findOrFail($id);
            $_card = Card::findOrFail($_train->id_card);
            $_teacherStudent = TeacherStudent::findOrFail($_card->id_teacher_student);
            if ($_teacherStudent->id_teacher != $_teacher->id) {
                return response()->json(['result' => false, 'message' => "ID de aluno não pertence a este professor!"]);
            }

            $_train->delete();
            
        } catch(Exception $ex) {
            return response()->json([
                'result' => false, 
                'message' => "Erro ao remover o treino!", 
                'ex' => $ex->getMessage()
            ]);
        }
        return response()->json(['result' => true, 'message' => "Treino removido com sucesso!"]);
    }
}
