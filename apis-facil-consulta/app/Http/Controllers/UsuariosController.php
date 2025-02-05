<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;

class UsuariosController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $usuarios = User::all();

            if (empty($usuarios)) {
                return response()->json([
                    'status'  => 404,
                    'success' => false,
                    'msg'     => 'Nenhum usuário encontrado',
                ], 404);
            }

            return response()->json($usuarios, 200);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 500,
                'success' => false,
                'msg'     => 'Erro ao retornar dados: ' . $e->getMessage(),
                'data'    => now()->format('Y-m-d H:i:s'),
            ], 500);
        }
    }
}
