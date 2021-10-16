<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Models\File;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeacherStudent;
use App\Models\Template;
use App\Models\User;
use App\Models\Util;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

/**
 * @group User
 *
 * Gerenciamento de usuário
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $data = User::all();

        return response()->json(['result' => true, 'data' => $data]);
    }

    /**
     * 
     * Cadastrar novo usuário
     * 
     * Cadastra um novo usuário Personal Trainer. O response em caso de sucesso 200 é a própria requisição dentro de 'data'.
     *
     * @bodyParam  name string required Nome do usuário. Example: Matheus
     * @bodyParam  email string required E-mail do usuário usado para acesso ao app. Example: contato@octopusfit.com.br
     * @bodyParam  password string required Senha de 6 caracteres com letras, números e caracteres especiais. Example: 123!abc
     * @bodyParam  cpf string CPF sem acentuação. Example: 12345678980
     * @bodyParam  cnpj string CNPJ sem acentuação.
     * 
     * @response {
     *   "result": true,
     *   "data": {
     *   },
     *   "message": "Mensagem de erro se houver"
     * }
     */
    public function store(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'name' => 'required|min:6|max:100',
                'email' => 'email|unique:App\Models\User,email|required|max:80',
                'password' => ['required', 'min:6', 'regex:/[a-z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
                'cpf' => 'nullable|cpf|size:11',
                'cnpj' => 'nullable|cnpj|size:14',
            ]);

            if ($validation->fails()) {
                return response()->json(['result' => false, 'message' => "Campos incorretos!", 'data' => $validation->errors()]);
            }

            $pass = Hash::make($request->input('password'));
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $pass,
                'cpf' => $request->input('cpf'),
                'cnpj' => $request->input('cnpj'),
                'phone' => $request->input('phone'),
                'type' => "T",
                'status' => "A",
            ]);
    
            unset($user['password']);
            return response()->json(['result' => true, 'data' => $user]);
        } catch(Exception $ex) {
            return response()->json([
                'result' => false, 
                'message' => "Erro ao inserir novo usuário!", 
                'ex' => $ex->getMessage()
            ]);
        }
    }

    /**
     * 
     * Exibir dados do usuário
     * 
     * Recupera as informações do usuário logado. Alguns itens podem variar dependendo do tipo de usuário logado: Professor (T) ou Aluno (S). Por exemplo, o campo terms_use só existe para os professores.
     *
     * @authenticated
     * 
     * @response 200 {
     *   "result": true,
     *   "data": {
     *       "id": 1,
     *       "name": "PERSONAL MATHEUS",
     *       "email": "contato@octopusfit.com.br",
     *       "cpf": "12345678980",
     *       "cnpj": null,
     *       "phone": null,
     *       "photo": "http:\/\/127.0.0.1:8000\/storage\/images\/1\/6XuZiqUlIVqsuPC9aXZSaV7d7cvmltxWg79izMTS.jpg",
     *       "media_facebook": "https:\/\/facebook.com\/usuario",
     *       "media_instagram": null,
     *       "media_whatsapp": null,
     *       "terms_use": "http:\/\/127.0.0.1:8000\/storage\/terms\/1\/byWMlIyaSD8KAJSve2tQdGtzwIPqH4LIgBpLe2ED.pdf",
     *       "status": "A",
     *       "genre": "M",
     *       "dt_born": "01/01/1970",
     *       "type": "T",
     *       "token": "eyaeXAi85dJhbGcdiJIUzI1NiJ9.HRwOjgXC8xMjcuMC4",
     *       "created_at": "2021-09-24T22:47:24.000000Z",
     *       "updated_at": "2021-09-28T01:24:23.000000Z"
     *   }
     * }
     * 
     * @response 200 {
     *   "result": true,
     *   "data": {
     *       "id": 2,
     *       "name": "JUQUINHA",
     *       "email": "juquinha@gmail.com",
     *       "cpf": null,
     *       "phone": null,
     *       "photo": null,
     *       "media_facebook": null,
     *       "media_instagram": null,
     *       "media_whatsapp": null,
     *       "status": "A",
     *       "genre": "M",
     *       "dt_born": "01/01/1970",
     *       "type": "S",
     *       "token": "eyaeXAi85dJhbGcdiJIUzI1NiJ9.HRwOjgXC8xMjcuMC4",
     *       "created_at": "2021-10-15T21:42:22.000000Z",
     *       "updated_at": "2021-10-15T22:41:20.000000Z",
     *       "info": {
     *         "type_student": "P",
     *         "type_contract": "S",
     *         "notes": null,
     *         "status": "A",
     *         "anamnesis": {
     *           "id_required_anamnesis": 2,
     *           "url_required_anamnesis": "http:\/\/127.0.0.1:8000\/storage\/files\/1\/b4zQVLi6wAhiROK6UMqqnPDxBSnJ6cJFCXmm8RqZ.pdf",
     *           "description_required_anamnesis": "ANAMNESE NOVO ALUNO",
     *           "id_uploaded_anamnesis": 3,
     *           "url_uploaded_anamnesis": "http:\/\/127.0.0.1:8000\/storage\/files\/1\/b4zQVLi6wAhiROK6UMqqnPDxBSnJ6cJFCXmm8RqZ.pdf",
     *           "description_uploaded_anamnesis": null
     *         },
     *         "teacher": {
     *           "id": 1,
     *           "name": "PERSONAL MATHEUS",
     *           "media_facebook": "https:\/\/facebook.com\/usuario",
     *           "media_instagram": null,
     *           "media_whatsapp": null,
     *           "genre": "M"
     *         }
     *       }
     *   }
     * }
     */
    public function show()
    {
        $_user = auth('api')->user();

        if ($_user->isTeacher()) {
            $_user = Teacher::where('id', $_user->id)->first();
        } else {
            $_user = Student::where('id', $_user->id)->first();
            $_user->info->anamnesis = TeacherStudent::getAnamnesisInfo($_user->info->id_required_anamnesis, $_user->info->id_uploaded_anamnesis);
            unset($_user->info->id_required_anamnesis);
            unset($_user->info->id_uploaded_anamnesis);
        }

        $_file = $_user->photo()->first();
        if ($_file) {
            $_user->photo = env('APP_URL').'storage/'.$_file->path;
        }

        return response()->json(['result' => true, 'data' => $_user]);
    }

    /**
     * 
     * Alterar senha
     * 
     * Altera a senha de um usuário.
     *
     * @authenticated
     * 
     * @bodyParam  password string required Senha de 6 caracteres com letras, números e caracteres especiais. Example: 123!abc
     * 
     * @response {
     *  "result": true,
     *  "message": "Alguma mensagem de erro, se existir.",
     *  "access_token": "eyaeXAi85dJhbGcdiJIUzI1NiJ9.HRwOjgXC8xMjcuMC4",
     *  "token_type": "bearer"
     * }
     */
    public function updatePass(Request $request)
    {
        try {
            $user = auth('api')->user();

            $validation = Validator::make($request->all(), [
                'password' => ['required', 'min:6', 'regex:/[a-z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            ]);

            if ($validation->fails()) {
                return response()->json(
                    ['result' => false, 
                    'message' => "Senha incorreta. Utilize um mínimo de 6 caracteres entre letras, números e caracteres especiais!", 
                    'data' => $validation->errors()]);
            }

            $pass = Hash::make($request->input('password'));

            $user->password = $pass;
            $user->temp_password = null;
            $user->token = auth()->login($user);

            $user->save();
    
            return response()->json([
                'result' => true, 
                'access_token' => $user->token,
                'token_type' => 'bearer',
            ]);
        } catch(Exception $ex) {
            return response()->json([
                'result' => false, 
                'message' => "Erro ao atualizar a senha!", 
                'ex' => $ex->getMessage()
            ]);
        }
    }

    /**
     * 
     * Redefinir senha
     * 
     * Funcionalidade da tela inicial para redefinição de senha por esquecimento. 
     * Depois do primeiro login com a nova senha, a chave 'reset_password' ficará como true e o app deverá direcionar o usuário para uma tela onde deverá ser escolhida a senha definitiva. Para tanto, chamar o endpoint 'Alterar senha'.
     *
     * @bodyParam  email string required E-mail do usuário usado para acesso ao app. Example: contato@octopusfit.com.br
     * 
     * @response {
     *  "result": true,
     *  "message": "Foi enviado um e-mail para $email com a nova senha de acesso!"
     * }
     */
    public function forgotPass(Request $request) {
        $validation = Validator::make($request->all(), [
            'email' => 'email|required|max:80',
        ]);

        if ($validation->fails()) {
            return response()->json(
                ['result' => false, 
                'message' => "E-mail em formato incorreto!", 
                'data' => $validation->errors()]);
        }

        $email = $request->input('email');

        try {
            $_user = User::where('email', $email)->firstOrFail();
        } catch(Exception $ex) {
            return response()->json([
                'result' => false, 
                'message' => "E-mail não encontrado ou não pertence a este usuário!", 
                // 'ex' => $ex->getMessage()
            ]);
        }

        $_template = Template::where('resume', 'EMAIL-RESET-SENHA')->firstOrFail();
        $newPass = Util::makePass();
        $content = str_replace('{nova_senha}', $newPass, $_template->content);

        try {
            $mail = new Email($email, $_template->name, $content);
            $mail->send();
            
            $_user->temp_password = $newPass;
            $_user->save();

        } catch(Exception $ex) {
            return response()->json([
                'result' => false, 
                'message' => "Erro ao redefinir a senha! Entre em contato com o administrador do sistema.", 
                // 'ex' => $ex->getMessage()
            ]);
        }
        
        return response()->json(['result' => true, 'message' => "Foi enviado um e-mail para $email com a nova senha de acesso!"]);
    }

    /**
     * 
     * Salvar imagem de perfil
     * 
     * Salva a imagem de perfil do usuário.
     *
     * @authenticated
     * 
     * @bodyParam  photo file required Imagem em png ou jpg com maximo de 2048 kb. No-example
     * 
     * @response {
     *   "result": true,
     *   "data": {
     *     "photo": "http:\/\/127.0.0.1:8000\/storage\/images\/1\/6XuZiqUlIVqsuPC9aXZSaV7d7cvmltxWg79izMTS.jpg"
     *   }
     * }
     */
    public function savePhoto(Request $request) {
        $user = auth('api')->user();

        $validation = Validator::make($request->all(), [
            'photo' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($validation->fails()) {
            return response()->json(['result' => false, 'message' => "Campos incorretos!", 'data' => $validation->errors()]);
        }
        
        $_image = null;
        if ($user->photo) {
            $_image = $user->photo()->first();
            Storage::disk('public')->delete($_image->path);
        }

        $image = $request->file('photo');
        $_file = File::create([
            'description' => 'Perfil',
            'path' => $image->store('images/'.$user->id, 'public'),
            'type' => $image->getMimeType(),
        ]);
        $user->photo = $_file->id;
        $user->save();

        if ($_image) {
            $_image->delete();
        }

        return response()->json(['result' => true, 'data' => ['photo' => env('APP_URL').'storage/'.$_file->path]]);
    }

    /**
     * 
     * Remover imagem de perfil
     * 
     * Remove a imagem de perfil do usuário.
     *
     * @authenticated
     * 
     * @response {
     *   "result": true,
     *   "message": "Foto removida com sucesso!"
     * }
     */
    public function removePhoto(Request $request) {
        $user = auth('api')->user();
        $user = User::findOrFail($user['id']);

        if ($user->photo) {
            $_image = $user->photo()->first();
            Storage::disk('public')->delete($_image->path);
            
            $user->photo = null;
            $user->save();

            $_image->delete();
        }

        return response()->json(['result' => true, 'message' => "Foto removida com sucesso!"]);
    }
}
