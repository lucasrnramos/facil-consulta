<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function register(Request $request): JsonResponse
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user, 201);
    }

    public function login(Request $request): JsonResponse
    {
        $validador = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validador->fails()) {
            return response()->json($validador->errors(), 422);
        }

        $credenciais = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credenciais)) {
            return response()->json([
                'status'  => 401,
                'success' => false,
                'msg'     => 'Login e/ou senha inválidos. Acesso não permitido',
                'data'    => $currentTime,
            ], 401);
        }

        return $this->createNewToken($token);
    }

    public function logout(): JsonResponse
    {
        auth()->logout();
        return response()->json(['message' => 'Usuário deslogado com sucesso!']);
    }

    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    protected function createNewToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60,
            'user'         => auth('api')->user()
        ]);
    }

    public function verify(Request $request): JsonResponse
    {
        try {
            // Verifique se o usuário está autenticado
            if (!auth()->guard('api')->check()) {
                return response()->json([
                    'status'  => 401,
                    'success' => false,
                    'msg'     => 'Token inválido. Acesso não permitido.',
                    'data'    => date('Y-m-d H:i:s')
                ], 401);
            }

            // Se o usuário estiver autenticado, retorne um status 200
            return response()->json([
                'status'  => 200,
                'success' => true,
                'msg'     => 'Token válido.',
                'data'    => date('Y-m-d H:i:s')
            ], 200);

        } catch (Exception $e) {
            // Se houver um erro, retorne um status 500
            return response()->json([
                'status'  => 500,
                'success' => false,
                'msg'     => 'Erro ao verificar o token.',
                'data'    => date('Y-m-d H:i:s')
            ], 500);
        }
    }
}
