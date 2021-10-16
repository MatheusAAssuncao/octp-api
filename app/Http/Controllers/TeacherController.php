<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Models\File;
use App\Models\Student;
use App\Models\TeacherStudent;
use App\Models\Template;
use App\Models\Util;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * @group Teacher
 *
 * Gerenciamento de usuário do tipo professor
 */
class TeacherController extends Controller
{

    /**
     * 
     * Listagem de alunos
     * 
     * Lista os alunos vinculados ao professor
     *
     * @authenticated
     * 
     * @response {
     *   "result": true,
     *   "data": [{
     *     "id_student": 2,
     *     "name": "JUQUINHA",
     *     "status": "A",
     *     "type_student": "P",
     *     "type_contract": "S",
     *     "notes": null,
     *     "created_at": "2021-10-15 18:42:22",
     *     "updated_at": "2021-10-15 19:16:05",
     *     "anamnesis": {
     *       "id_required_anamnesis": 2,
     *       "url_required_anamnesis": "http:\/\/127.0.0.1:8000\/storage\/files\/1\/b4zQVLi6wAhiROK6UMqqnPDxBSnJ6cJFCXmm8RqZ.pdf",
     *       "description_required_anamnesis": "ANAMNESE NOVO ALUNO",
     *       "id_uploaded_anamnesis": null,
     *       "url_uploaded_anamnesis": null,
     *       "description_uploaded_anamnesis": null
     *     }
     *   }]
     * }
     */
    public function index()
    {
        $_teacher = auth('api')->user();
        if (!$_teacher->isTeacher()) {
            abort(404);
        }

        $columns = array(
            'teacher_students.id_student',
            'user.name',
            'teacher_students.status',
            'teacher_students.type_student',
            'teacher_students.type_contract',
            'teacher_students.notes',
            'teacher_students.id_required_anamnesis',
            'teacher_students.id_uploaded_anamnesis',
            'teacher_students.created_at',
            'teacher_students.updated_at',
        );

        $students = DB::table('teacher_students')
            ->select($columns)
            ->join('user', 'user.id', '=', 'teacher_students.id_student')
            ->where('teacher_students.id_teacher', $_teacher->id)
            ->orderBy('user.name')
            ->get();

        if (!$students) {
            return response()->json(['result' => true, 'data' => []]);
        }

        foreach ($students as &$student) {
            $student->anamnesis = TeacherStudent::getAnamnesisInfo($student->id_required_anamnesis, $student->id_uploaded_anamnesis);
            unset($student->id_required_anamnesis);
            unset($student->id_uploaded_anamnesis);
        }

        return response()->json(['result' => true, 'data' => $students]);
    }

    /**
     * 
     * Alterar dados do professor
     * 
     * Altera as informações do professor logado. O response em caso de sucesso 200 é a própria requisição dentro de 'data'.
     *
     * @authenticated
     * 
     * @bodyParam  name string required Nome do professor. Example: Matheus
     * @bodyParam  cpf string CPF sem acentuação. Example: 12345678980
     * @bodyParam  cnpj string CNPJ sem acentuação. Example: 73942003000118
     * @bodyParam  phone string Número de telefone sem acentuação. Example: 19991501844
     * @bodyParam  media_facebook string URL do Facebook do professor. Example: https://facebook.com/professor
     * @bodyParam  media_instagram string Conta no Instagram do professor. Example: @linchester
     * @bodyParam  media_whatsapp string Número do WhatsApp do professor. Example: 19991501844
     * @bodyParam  terms_use string Termo de uso digitado (caso ele não opte pelo upload do PDF).
     * @bodyParam  genre string required Gênero (sexo) do professor, sendo M - Masculino, F - Feminino, O - Outro
     * @bodyParam  dt_born date Data de nascimento. Example: 01/01/1970
     * 
     * @response {
     *   "result": true,
     *   "data": {
     *   },
     *   "message": "Mensagem de erro se houver"
     * }
     */
    public function update(Request $request)
    {
        try {
            $_teacher = auth('api')->user();
            if (!$_teacher->isTeacher()) {
                abort(404);
            }

            $validation = Validator::make($request->all(), [
                'name' => 'required|min:6|max:100',
                'cpf' => 'nullable|cpf|size:11',
                'cnpj' => 'nullable|cnpj|size:14',
                'media_facebook' => 'nullable|max:50',
                'media_instagram' => 'nullable|max:20',
                'media_whatsapp' => 'nullable|max:20',
                'terms_use' => 'nullable|max:255',
                'genre' => 'required|size:1|in:M,F,O',
                'dt_born' => 'nullable|date_format:d/m/Y|before:today',
            ]);

            if ($validation->fails()) {
                return response()->json(['result' => false, 'message' => "Campos incorretos!", 'data' => $validation->errors()]);
            }

            $_teacher->name = $request->input('name');
            $_teacher->cpf = $request->input('cpf');
            $_teacher->cnpj = $request->input('cnpj');
            $_teacher->media_facebook = $request->input('media_facebook');
            $_teacher->media_instagram = $request->input('media_instagram');
            $_teacher->media_whatsapp = $request->input('media_whatsapp');
            $_teacher->phone = $request->input('phone');
            $_teacher->terms_use = $request->input('terms_use');
            $_teacher->genre = $request->input('genre');
            $_teacher->dt_born = $request->input('dt_born');
            $_teacher->save();
    
            return response()->json(['result' => true, 'data' => $request->all()]);
        } catch(Exception $ex) {
            return response()->json([
                'result' => false, 
                'message' => "Erro ao atualizar professor!", 
                'ex' => $ex->getMessage()
            ]);
        }
    }

    /**
     * 
     * Adiciona e convida um novo aluno
     * 
     * Cadastra e envia um e-mail a um novo aluno vinculado ao professor logado. No e-mail contém a senha para o primeiro acesso.
     *
     * @authenticated
     * 
     * @bodyParam  name string required Nome do professor. Example: Matheus
     * @bodyParam  phone string Número de telefone sem acentuação. Example: 19991501844
     * @bodyParam  type_student string required Tipo de aluno: P - presencial, O - online. Example: P
     * @bodyParam  type_contract string required Tipo de contrato: M - mensal, T - trimestral, S - semestral. Example: T
     * @bodyParam  photo file Imagem em png ou jpg com maximo de 2048 kb. No-example
     * @bodyParam  notes string Texto com máximo de 255 caracteres. Example: Aluno antigo da escola
     * 
     * @response {
     *   "result": true,
     *   "data": {
     *   },
     *   "message": "Mensagem de erro se houver"
     * }
     */
    public function newStudent(Request $request)
    {
        
        $_teacher = auth('api')->user();
        if (!$_teacher->isTeacher()) {
            abort(404);
        }

        $validation = Validator::make($request->all(), [
            'name' => 'required|min:6|max:100',
            'email' => 'required|email|unique:App\Models\User,email|max:80',
            'type_student' => 'required|size:1|in:P,O', // presencial, online
            'type_contract' => 'required|size:1|in:M,T,S', // mensal, trimestral, semestral
            'phone' => 'nullable|max:13',
            'photo' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'notes' => 'nullable|max:255',
        ]);

        if ($validation->fails()) {
            return response()->json(['result' => false, 'message' => "Campos incorretos!", 'data' => $validation->errors()]);
        }
        
        $newPass = Util::makePass();
        $_student = Student::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($newPass),
            'type' => "S",
            'phone' => $request->input('phone'),
            'status' => "A",
        ]);

        if ($request->file('photo')) {
            $image = $request->file('photo');
            $_file = File::create([
                'description' => 'Perfil',
                'path' => $image->store('images/'.$_student->id, 'public'),
                'type' => $image->getMimeType(),
            ]);
            $_student->photo = $_file->id;
            $_student->save();
        }

        TeacherStudent::create([
            'id_teacher' => $_teacher->id,
            'id_student' => $_student->id,
            'type_student' => $request->input('type_student'),
            'type_contract' => $request->input('type_contract'),
            'notes' => $request->input('notes'),
            'status' => "A",
        ]);

        $_template = Template::where('resume', 'EMAIL-CONVITE-ALUNO')->firstOrFail();
        $content = $_template->content;
        $content = str_replace('{nome_prof}', $_teacher->name, $content);
        $content = str_replace('{email_prof}', $_teacher->email, $content);
        $content = str_replace('{email}', $request->input('email'), $content);
        $content = str_replace('{nova_senha}', $newPass, $content);

        try {
            $mail = new Email($request->input('email'), $_template->name, $content);
            $mail->send();

        } catch(Exception $ex) {
            return response()->json([
                'result' => false, 
                'message' => "Erro ao adicionar um novo aluno! Entre em contato com o administrador do sistema.", 
                // 'ex' => $ex->getMessage()
            ]);
        }

        return response()->json(['result' => true, 'data' => $request->all()]);
    }

    /**
     * 
     * Atualiza dados do aluno
     * 
     * Permite que o professor atualize dados do cadastro de um aluno.
     *
     * @authenticated
     * 
     * @bodyParam  id_student integer required ID do aluno. Example: Matheus
     * @bodyParam  type_student string required Tipo de aluno: P - presencial, O - online. Example: P
     * @bodyParam  type_contract string required Tipo de contrato: M - mensal, T - trimestral, S - semestral. Example: T
     * @bodyParam  status string required Status do aluno. Aqui é possível bloquear o acesso no login se definido I (inativo). Exampe: A
     * @bodyParam  notes string Texto com máximo de 255 caracteres. Example: Aluno antigo da escola
     * @bodyParam  id_required_anamnesis integer ID do documento de anamnese caso o professor queira solicitar preenchimento de anamnese. Ver módulo 'File'
     * 
     * @response {
     *   "result": true,
     *   "data": {
     *   },
     *   "message": "Mensagem de erro se houver"
     * }
     */
    public function updateStudent(Request $request)
    {
        
        $_teacher = auth('api')->user();
        if (!$_teacher->isTeacher()) {
            abort(404);
        }

        $validation = Validator::make($request->all(), [
            'id_student' => 'required|exists:App\Models\User,id',
            'type_student' => 'required|size:1|in:P,O', // presencial, online
            'type_contract' => 'required|size:1|in:M,T,S', // mensal, trimestral, semestral
            'status' => 'required|size:1|in:A,I',
            'notes' => 'nullable|max:255',
            'id_required_anamnesis' => 'nullable|exists:App\Models\File,id'
        ]);

        if ($validation->fails()) {
            return response()->json(['result' => false, 'message' => "Campos incorretos!", 'data' => $validation->errors()]);
        }
        
        $_teacherStudent = TeacherStudent::where('id_teacher', $_teacher->id)
            ->where('id_student', $request->input('id_student'))
            ->first();

        if (!$_teacherStudent) {
            return response()->json(['result' => false, 'message' => 'Aluno não encontrado para este professor!']);
        }

        if ($request->input('id_required_anamnesis')) {
            if ($_teacherStudent->id_uploaded_anamnesis && 
                $_teacherStudent->id_required_anamnesis != $request->input('id_required_anamnesis')) {
                return response()->json(['result' => false, 'message' => "Outra anamnese já foi respondida pelo aluno!"]);
            }
        }

        $_teacherStudent->type_contract = $request->input('type_contract');
        $_teacherStudent->type_student = $request->input('type_student');
        $_teacherStudent->status = $request->input('status');
        $_teacherStudent->notes = $request->input('notes');
        $_teacherStudent->id_required_anamnesis = $request->input('id_required_anamnesis');
        $_teacherStudent->save();

        return response()->json(['result' => true, 'data' => $request->all()]);
    }
}
