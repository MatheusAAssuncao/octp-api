<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Student;
use App\Models\TeacherStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * @group Student
 *
 * Gerenciamento de usuário do tipo aluno
 */
class StudentController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Student $student)
    {
        //
    }

    public function update(Request $request, Student $student)
    {
        //
    }

    public function destroy(Student $student)
    {
        //
    }

    /**
     * 
     * Upload de anamnese
     * 
     * Permite que o aluno faça upload do arquivo PDF de anamnese preenchido.
     *
     * @authenticated
     * 
     * @bodyParam  description string Descrição opcional. No-example
     * @bodyParam  file file required Deve ser um arquivo com maximo de 2048 kb. No-example
     * 
     * @response {
     *   "result": true,
     *   "data": {
     *      "url": "http:\/\/127.0.0.1:8000\/storage\/files\/1\/6XuZiqUlIVqsuPC9aXZSaV7d7cvmltxWg79izMTS.pdf"
     *   },
     *   "message": "Mensagem de erro se houver"
     * }
     */
    public function uploadAnamnesis(Request $request)
    {
        $_user = auth('api')->user();
        if (!$_user->isStudent()) {
            abort(404);
        }

        $validation = Validator::make($request->all(), [
            'description' => 'nullable|min:6|max:35',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        if ($validation->fails()) {
            return response()->json(['result' => false, 'message' => "Campos incorretos!", 'data' => $validation->errors()]);
        }

        $_student = Student::findOrFail($_user->id);
        if (!$_student->info->id_required_anamnesis) {
            return response()->json(['result' => false, 'message' => "Não existe anamnese vinculada a este aluno!"]);
        }

        $_student->info->anamnesis = TeacherStudent::getAnamnesisInfo($_student->info->id_required_anamnesis, null);

        if ($request->input('description')) {
            $description = $request->input('description');
        } else {
            $description = $_student->info->anamnesis['description_required_anamnesis'];
        }
        
        $document = $request->file('file');
        $_file = File::create([
            'id_user' => $_student->id,
            'description' => $description,
            'category' => 'ANAMNESE',
            'path' => $document->store('files/'.$_student->id, 'public'),
            'type' => $document->getMimeType(),
        ]);

        if (!$_file) {
            return response()->json(['result' => false, 'message' => "Erro ao fazer upload do arquivo!"]);
        }

        DB::update('UPDATE teacher_students SET id_uploaded_anamnesis = ? WHERE id_student = ? AND id_required_anamnesis = ?',
            [$_file->id, $_student->id, $_student->info->id_required_anamnesis]
        );

        return response()->json(['result' => true, 'data' => ['url' => env('APP_URL').'storage/'.$_file->path]]);
    }
}
