<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Support\Facades\Validator;

class PacientesController extends Controller
{
    public function update(Request $request, $id_paciente): JsonResponse
    {
        try {

            $paciente = Paciente::find($id_paciente);

            if (!$paciente) {
                return response()->json([
                    'status'  => 404,
                    'success' => false,
                    'msg'     => 'Paciente não encontrado',
                ], 404);
            }

            $paciente->nome    = $request->post('nome');
            $paciente->celular = $request->post('celular');

            if ($paciente->save()) {
                return response()->json(
                    [
                       'nome'    => $paciente->nome,
                       'celular' => $paciente->celular
                    ], 200);
            } else {
                return response()->json([
                    'status'  => 500,
                    'success' => false,
                    'msg'     => 'Erro ao atualizar o paciente',
                ], 500);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 500,
                'success' => false,
                'msg'     => 'Erro ao retornar dados: ' . $e->getMessage(),
                'data'    => now()->format('Y-m-d H:i:s'),
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {

            $regras = [
                "nome"    => "required|string",
                "cpf"     => "required|string|max:20",
                "celular" => "required|string|max:20",
            ];

            $mensagens = [
                "nome.required"    => "O campo nome é obrigatório",
                "nome.string"      => "O campo nome deve ser uma string",
                "cpf.required"     => "O campo cpf é obrigatório",
                "cpf.string"       => "O campo cpf deve ser uma string",
                "cpf.max"          => "O campo cpf deve ter no máximo 20 caracteres",
                "celular.required" => "O campo celular é obrigatório",
                "celular.string"   => "O campo celular deve ser uma string",
                "celular.max"      => "O campo celular deve ter no máximo 20 caracteres",
            ];

            $validador = Validator::make($request->all(), $regras, $mensagens);

            if ($validador->fails()) {
                return response()->json([
                    'status'  => 400,
                    'success' => false,
                    'msg'     => 'Erro ao validar os dados',
                    'data'    => $validador->errors(),
                ], 400);
            }

            $paciente = new Paciente();
            $paciente->nome    = $request->post('nome');
            $paciente->cpf     = $request->post('cpf');
            $paciente->celular = $request->post('celular');

            if ($paciente->save()) {
                return response()->json(
                    [
                        'nome'    => $paciente->nome,
                        'cpf'     => $paciente->cpf,
                        'celular' => $paciente->celular
                    ], 201);
            } else {
                return response()->json([
                    'status'  => 500,
                    'success' => false,
                    'msg'     => 'Erro ao salvar o paciente',
                ], 500);
            }

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
