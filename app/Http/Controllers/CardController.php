<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\TeacherStudent;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Card
 *
 * Gerenciamento de fichas
 */
class CardController extends Controller
{
    /**
     * 
     * Listagem de fichas
     * 
     * Lista as fichas cadastradas para o aluno
     *
     * @authenticated
     * 
     * @queryParam id required O ID do aluno.
     * 
     * @response {
     *   "result": true,
     *   "data": [{
     *        "id": 1,
     *        "name": "FICHA DE ADAPTAÇÃO",
     *        "description": "TREINO TEMPORÁRIO DE ADAPTAÇÃO DOS GRUPOS MUSCULARES",
     *        "id_teacher_student": 1,
     *        "id_user": 1,
     *        "dt_end": "01\/12\/2022",
     *        "times": null,
     *        "status": "A",
     *        "created_at": "2021-10-30T14:02:23.000000Z",
     *        "updated_at": "2021-10-30T14:02:23.000000Z",
     *        "trains": [
     *            {
     *            "id": 12,
     *            "name": "A",
     *            "break": 120,
     *            "id_card": 1,
     *            "created_at": "2021-11-01T19:55:24.000000Z",
     *            "updated_at": "2021-11-01T19:55:24.000000Z",
     *            "exercise_groups": [
     *                {
     *                "id": 11,
     *                "type": "TRADICIONAL",
     *                "id_train": 12,
     *                "order": 1,
     *                "created_at": "2021-11-01T19:55:24.000000Z",
     *                "updated_at": "2021-11-01T19:55:24.000000Z",
     *                "exercise_details": [
     *                    {
     *                    "id": 10,
     *                    "id_exercise": 1,
     *                    "id_exercise_group": 11,
     *                    "id_equipment": 1,
     *                    "url": null,
     *                    "repetition_type": "REPETIÇÕES",
     *                    "charge_type": "KILO",
     *                    "series_interval": 60,
     *                    "notes": "",
     *                    "created_at": "2021-11-01T19:55:24.000000Z",
     *                    "updated_at": "2021-11-01T19:55:24.000000Z",
     *                    "exercise": {
     *                        "id": 1,
     *                        "name": "SUPINO RETO",
     *                        "description": null,
     *                        "id_muscle_group": 4,
     *                        "id_equipment": 1,
     *                        "id_user": null,
     *                        "url": null,
     *                        "musclegroup": {
     *                        "id": 4,
     *                        "name": "PEITORAL"
     *                        },
     *                        "equipment": {
     *                        "id": 1,
     *                        "name": "BANCO SUPINO"
     *                        }
     *                    },
     *                    "exercise_series": [
     *                        {
     *                        "id": 25,
     *                        "id_exercise_detail": 10,
     *                        "charge": 30,
     *                        "repetition": 12,
     *                        "order": 1,
     *                        "created_at": "2021-11-01T19:55:24.000000Z",
     *                        "updated_at": "2021-11-01T19:55:24.000000Z"
     *                        },
     *                        {
     *                        "id": 26,
     *                        "id_exercise_detail": 10,
     *                        "charge": 30,
     *                        "repetition": 12,
     *                        "order": 2,
     *                        "created_at": "2021-11-01T19:55:24.000000Z",
     *                        "updated_at": "2021-11-01T19:55:24.000000Z"
     *                        },
     *                        {
     *                        "id": 27,
     *                        "id_exercise_detail": 10,
     *                        "charge": 30,
     *                        "repetition": 12,
     *                        "order": 3,
     *                        "created_at": "2021-11-01T19:55:24.000000Z",
     *                        "updated_at": "2021-11-01T19:55:24.000000Z"
     *                        },
     *                        {
     *                        "id": 28,
     *                        "id_exercise_detail": 10,
     *                        "charge": 30,
     *                        "repetition": 12,
     *                        "order": 4,
     *                        "created_at": "2021-11-01T19:55:24.000000Z",
     *                        "updated_at": "2021-11-01T19:55:24.000000Z"
     *                        }
     *                    ]
     *                    }
     *                ]
     *                },
     *                {
     *                "id": 12,
     *                "type": "BI-SET",
     *                "id_train": 12,
     *                "order": 2,
     *                "created_at": "2021-11-01T19:55:24.000000Z",
     *                "updated_at": "2021-11-01T19:55:24.000000Z",
     *                "exercise_details": [
     *                    {
     *                    "id": 11,
     *                    "id_exercise": 2,
     *                    "id_exercise_group": 12,
     *                    "id_equipment": 1,
     *                    "url": null,
     *                    "repetition_type": "REPETIÇÕES",
     *                    "charge_type": "KILO",
     *                    "series_interval": 60,
     *                    "notes": "",
     *                    "created_at": "2021-11-01T19:55:24.000000Z",
     *                    "updated_at": "2021-11-01T19:55:24.000000Z",
     *                    "exercise": {
     *                        "id": 2,
     *                        "name": "CRUCIFIXO INCLINADO",
     *                        "description": null,
     *                        "id_muscle_group": 4,
     *                        "id_equipment": 2,
     *                        "id_user": null,
     *                        "url": null,
     *                        "musclegroup": {
     *                        "id": 4,
     *                        "name": "PEITORAL"
     *                        },
     *                        "equipment": {
     *                        "id": 2,
     *                        "name": "BANCO RECLINÁVEL"
     *                        }
     *                    },
     *                    "exercise_series": [
     *                        {
     *                        "id": 29,
     *                        "id_exercise_detail": 11,
     *                        "charge": 30,
     *                        "repetition": 12,
     *                        "order": 1,
     *                        "created_at": "2021-11-01T19:55:24.000000Z",
     *                        "updated_at": "2021-11-01T19:55:24.000000Z"
     *                        },
     *                        {
     *                        "id": 30,
     *                        "id_exercise_detail": 11,
     *                        "charge": 30,
     *                        "repetition": 12,
     *                        "order": 2,
     *                        "created_at": "2021-11-01T19:55:24.000000Z",
     *                        "updated_at": "2021-11-01T19:55:24.000000Z"
     *                        },
     *                        {
     *                        "id": 31,
     *                        "id_exercise_detail": 11,
     *                        "charge": 30,
     *                        "repetition": 12,
     *                        "order": 3,
     *                        "created_at": "2021-11-01T19:55:24.000000Z",
     *                        "updated_at": "2021-11-01T19:55:24.000000Z"
     *                        },
     *                        {
     *                        "id": 32,
     *                        "id_exercise_detail": 11,
     *                        "charge": 30,
     *                        "repetition": 12,
     *                        "order": 4,
     *                        "created_at": "2021-11-01T19:55:24.000000Z",
     *                        "updated_at": "2021-11-01T19:55:24.000000Z"
     *                        }
     *                    ]
     *                    },
     *                    {
     *                    "id": 12,
     *                    "id_exercise": 3,
     *                    "id_exercise_group": 12,
     *                    "id_equipment": 1,
     *                    "url": null,
     *                    "repetition_type": "REPETIÇÕES",
     *                    "charge_type": "KILO",
     *                    "series_interval": 60,
     *                    "notes": "",
     *                    "created_at": "2021-11-01T19:55:24.000000Z",
     *                    "updated_at": "2021-11-01T19:55:24.000000Z",
     *                    "exercise": {
     *                        "id": 3,
     *                        "name": "CROSS OVER",
     *                        "description": null,
     *                        "id_muscle_group": 4,
     *                        "id_equipment": 1,
     *                        "id_user": null,
     *                        "url": null,
     *                        "musclegroup": {
     *                        "id": 4,
     *                        "name": "PEITORAL"
     *                        },
     *                        "equipment": {
     *                        "id": 1,
     *                        "name": "BANCO SUPINO"
     *                        }
     *                    },
     *                    "exercise_series": [
     *                        {
     *                        "id": 33,
     *                        "id_exercise_detail": 12,
     *                        "charge": 30,
     *                        "repetition": 12,
     *                        "order": 1,
     *                        "created_at": "2021-11-01T19:55:24.000000Z",
     *                        "updated_at": "2021-11-01T19:55:24.000000Z"
     *                        },
     *                        {
     *                        "id": 34,
     *                        "id_exercise_detail": 12,
     *                        "charge": 30,
     *                        "repetition": 12,
     *                        "order": 2,
     *                        "created_at": "2021-11-01T19:55:24.000000Z",
     *                        "updated_at": "2021-11-01T19:55:24.000000Z"
     *                        },
     *                        {
     *                        "id": 35,
     *                        "id_exercise_detail": 12,
     *                        "charge": 30,
     *                        "repetition": 12,
     *                        "order": 3,
     *                        "created_at": "2021-11-01T19:55:24.000000Z",
     *                        "updated_at": "2021-11-01T19:55:24.000000Z"
     *                        },
     *                        {
     *                        "id": 36,
     *                        "id_exercise_detail": 12,
     *                        "charge": 30,
     *                        "repetition": 12,
     *                        "order": 4,
     *                        "created_at": "2021-11-01T19:55:24.000000Z",
     *                        "updated_at": "2021-11-01T19:55:24.000000Z"
     *                        }
     *                    ]
     *                    }
     *                ]
     *                }
     *            ]
     *            }
     *        ]
     *        }]
     * }
     */
    public function index($id)
    {
        $user = auth('api')->user();
        if ($user->isTeacher()) {
            $_teacher_student = TeacherStudent::where('id_teacher', $user->id)
                ->where('id_student', $id)
                ->first();
            if (!$_teacher_student) {
                return response()->json(['result' => false, 'message' => "ID de aluno não pertence a este professor!", 'data' => $id]);
            }
        } else {
            if ($user->id != $id) {
                abort(404);
            }

            $_teacher_student = TeacherStudent::where('id_student', $id)->first();
        }

        $_card = Card::where('id_teacher_student', $_teacher_student->id)->get();
        
        return response()->json(['result' => true, 'data' => $_card]);
    }

    /**
     * 
     * Adiciona uma nova ficha
     * 
     * Cadastra uma ficha modelo caso o parâmetro id_student esteja nulo, do contrário atribui ao aluno.
     *
     * @authenticated
     * 
     * @bodyParam  name string required Nome da ficha. Example: Ficha de adaptação
     * @bodyParam  description string Descrição opcional. Example: Treino temporário de adaptação dos grupos musculares
     * @bodyParam  id_student integer ID do aluno
     * @bodyParam  dt_end date Data de término. Example: 01/01/2022
     * @bodyParam  times integer número de vezes que a ficha deve ser executada
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
            'name' => 'required|min:6|max:45',
            'description' => 'nullable|max:100',
            'id_student' => 'nullable|exists:App\Models\User,id',
            'dt_end' => 'nullable|date_format:d/m/Y|after:today',
            'times' => 'nullable|integer',
        ]);

        if ($validation->fails()) {
            return response()->json(['result' => false, 'message' => "Campos incorretos!", 'data' => $validation->errors()]);
        }

        try {
            $status = 'A';
            if ($request->input('id_student')) {
                $_teacherStudent = TeacherStudent::where('id_teacher', $_teacher->id)
                    ->where('id_student', $request->input('id_student'))
                    ->first();
                if (!$_teacherStudent) {
                    return response()->json(['result' => false, 'message' => "ID de aluno não pertence a este professor!", 'data' => $request->input('id_student')]);
                }

                $exists = Card::where('id_user', $_teacher->id)
                    ->where('id_teacher_student', $_teacherStudent->id)
                    ->where('status', 'A')
                    ->exists();
                $status = $exists ? 'I' : 'A';
            }
            
            $_card = Card::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'id_teacher_student' => $_teacherStudent->id,
                'id_user' => $_teacher->id,
                'dt_end' => $request->input('dt_end'),
                'times' => $request->input('times'),
                'status' => $status
            ]);

            return response()->json(['result' => true, 'data' => $_card]);

        } catch(Exception $ex) {
            return response()->json([
                'result' => false, 
                'message' => "Erro ao inserir nova ficha!", 
                'ex' => $ex->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Card $card)
    {
        //
    }

    public function edit(Card $card)
    {
        //
    }

    public function update(Request $request, Card $card)
    {
        //
    }

    public function destroy(Card $card)
    {
        //
    }
}
