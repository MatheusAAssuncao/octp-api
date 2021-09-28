<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;

/**
 * @group Auth
 *
 * Gerenciamento de login
 */
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     */
    public function __construct($email = null, $pass = null)
    {
        $this->middleware('auth:api', ['except' => ['login', 'logout']]);
    }

    /**
     * 
     * Login
     * 
     * Autenticação via e-mail e senha para obter um token JTW bearer.
     *
     * @bodyParam  email string required E-mail do usuário. Example: contato@octopusfit.com.br
     * @bodyParam  password string required Senha do usuário. Example: 123!abc
     * 
     * @response {
     *  "access_token": "eyaeXAi85dJhbGcdiJIUzI1NiJ9.HRwOjgXC8xMjcuMC4",
     *  "token_type": "bearer",
     *  "reset_password": false
     * }
     */
    public function login()
    {
        try {
            $credentials = request(['email', 'password']);
            $resetPass = false;

            if (! $token = auth()->attempt($credentials)) {
                $_user = User::where('temp_password', $credentials['password'])->first();
                if ($_user === null) {
                    throw new Exception("Unauthorized");
                }

                $user = auth()->setToken($_user->token)->user();
                $token = auth()->login($user);
                if (!$token) {
                    throw new Exception("Unauthorized");
                } else {
                    $resetPass = true;
                }
            }
    
            $user = auth('api')->user();
            $_user = User::find($user['id']);
            $_user->token = $token;
            $_user->save();
    
            return $this->respondWithToken($token, $resetPass);
        } catch (Exception $ex) {
            return response()->json(['result' => false, 'message' => "Não autorizado!", 'ex' => $ex->getMessage()], 401);
        }
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * 
     * Log-off
     * 
     * Faz log-off do usuário.
     *
     * @authenticated
     * 
     * @response {
     *  "result": true,
     *  "message": "Usuário deslogado!"
     * }
     * 
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['result' => true, 'message' => "Usuário deslogado!"]);
    }

    /**
     * 
     * Refresh
     * 
     * Atualiza o Token do usuário logado.
     *
     * @authenticated
     * 
     * @response {
     *  "access_token": "eyaeXAi85dJhbGcdiJIUzI1NiJ9.HRwOjgXC8xMjcuMC4",
     *  "token_type": "bearer",
     *  "reset_password": false
     * }
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     */
    protected function respondWithToken($token, $resetPass = false)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'reset_password' => $resetPass,
            // 'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}