<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CidadesController extends Controller
{
    public function retornaCidades(Request $request): JsonResponse
    {
        try {

            $regras = [
                "nome" => "required|string",
            ];

            $mensagens = [
                "required" => "O campo :attribute é obrigatório",
                "string"   => "O campo :attribute deve ser uma string",
            ];

            $validacao = Validator::make($request->all(), $regras, $mensagens);

            if ($validacao->fails()) {
                return response()->json([
                    'status'  => 400,
                    'success' => false,
                    'msg'     => 'Erro de validação de campos',
                    'data'    => $validacao->errors(),
                ], 400);
            }

            $nome = $request->input('nome');

            return response()
                ->json([
                    "status"  => 200,
                    "success" => true,
                    "msg"     => "Cidades retornadas com sucesso",
                    "object"  => $nome,
                    "data"    => now()->format('Y-m-d H:i:s'),
                ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 500,
                'success' => false,
                'msg'     => 'Erro ao retornar cidades: ' . $e->getMessage(),
                'data'    => now()->format('Y-m-d H:i:s'),
            ], 500);
        }
    }
}
