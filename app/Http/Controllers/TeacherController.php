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

        $_teacherStudent = TeacherStudent::create([
            'id_teacher' => $_teacher->id,
            'id_student' => $_student->id,
            'type_student' => $request->input('type_student'),
            'type_contract' => $request->input('type_contract'),
            'notes' => $request->input('notes'),
            'require_anamnesis' => 0,
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
}
