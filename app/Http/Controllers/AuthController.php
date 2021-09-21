<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct($email = null, $pass = null)
    {
        $this->middleware('auth:api', ['except' => ['login', 'logout']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
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

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['result' => true, 'message' => "Usuário deslogado!"]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
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