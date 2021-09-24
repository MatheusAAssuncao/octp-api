<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Models\File;
use App\Models\Template;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();

        return response()->json(['result' => true, 'data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $_user = User::findOrFail($id);

        $_file = $_user->photo()->first();
        if ($_file) {
            $_user->photo = env('APP_URL').'storage/'.$_file->path;
        }

        $_file = $_user->termsUse()->first();
        if ($_file) {
            $_user->terms_use = env('APP_URL').'storage/'.$_file->path;
        }

        return response()->json(['data' => $_user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validation = Validator::make($request->all(), [
                'name' => 'required|min:6|max:100',
                'cpf' => 'nullable|cpf|size:11',
                'cnpj' => 'nullable|cnpj|size:14',
                'media_facebook' => 'nullable|max:50',
                'media_instagram' => 'nullable|max:20',
                'media_whatsapp' => 'nullable|max:20',
                'terms_use' => 'nullable|max:255',
            ]);

            if ($validation->fails()) {
                return response()->json(['result' => false, 'message' => "Campos incorretos!", 'data' => $validation->errors()]);
            }

            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->cpf = $request->input('cpf');
            $user->cnpj = $request->input('cnpj');
            $user->media_facebook = $request->input('media_facebook');
            $user->media_instagram = $request->input('media_instagram');
            $user->media_whatsapp = $request->input('media_whatsapp');
            $user->phone = $request->input('phone');
            $user->terms_use = $request->input('terms_use');
            $user->save();
    
            return response()->json(['result' => true, 'data' => $request->all()]);
        } catch(Exception $ex) {
            return response()->json([
                'result' => false, 
                'message' => "Erro ao atualizar usuário!", 
                'ex' => $ex->getMessage()
            ]);
        }
    }

    public function updatePass(Request $request)
    {
        try {
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

            $user = auth('api')->user();
            $user = User::find($user['id']);
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
        $newPass = self::makePass();
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

    public function savePhoto(Request $request, $id) {
        $user = User::findOrFail($id);

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

        return response()->json(['result' => true, 'data' => env('APP_URL').'storage/'.$_file->path]);
    }

    public function removePhoto(Request $request, $id) {
        $user = User::findOrFail($id);

        if ($user->photo) {
            $_image = $user->photo()->first();
            Storage::disk('public')->delete($_image->path);
            
            $user->photo = null;
            $user->save();

            $_image->delete();
        }

        return response()->json(['result' => true, 'message' => "Foto removida com sucesso!"]);
    }

    public function saveTerm(Request $request, $id) {
        $user = User::findOrFail($id);

        $validation = Validator::make($request->all(), [
            'term' => 'required|mimes:pdf|max:2048',
        ]);

        if ($validation->fails()) {
            return response()->json(['result' => false, 'message' => "Campos incorretos!", 'data' => $validation->errors()]);
        }
        
        $_term = null;
        if ($user->id_tems_use) {
            $_term = $user->termsUse()->first();
            Storage::disk('public')->delete($_term->path);
        }

        $term = $request->file('term');
        $_file = File::create([
            'description' => 'Perfil',
            'path' => $term->store('terms/'.$user->id, 'public'),
            'type' => $term->getMimeType(),
        ]);
        $user->id_tems_use = $_file->id;
        $user->save();

        if ($_term) {
            $_term->delete();
        }

        return response()->json(['result' => true, 'data' => env('APP_URL').'storage/'.$_file->path]);
    }

    public function removeTerm(Request $request, $id) {
        $user = User::findOrFail($id);

        if ($user->id_tems_use) {
            $_term = $user->termsUse()->first();
            Storage::disk('public')->delete($_term->path);
            
            $user->id_tems_use = null;
            $user->save();

            $_term->delete();
        }

        return response()->json(['result' => true, 'message' => "Termo removido com sucesso!"]);
    }

    public static function makePass(){
        $mi = substr(str_shuffle("abcdefghijklmnopqrstuvyxwz"), 0, 3);
        $nu = substr(str_shuffle("0123456789"), 0, 2);
        $si = substr(str_shuffle("@$!%*#?&"), 0, 1);

        return str_shuffle($mi.$nu.$si);
    }
}
