<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MedicosController extends Controller
{
    public function show($nome = null)
    {
        try {

            if ($nome) {
                // Removendo pontos, vírgulas e espaços da string;
                $nome = str_replace(['.', ',', ' '], '', $nome);
                // Remover os prefixos "dr" e "dra" da string;
                $nome = preg_replace('/^dr\s*|^dra\s*/i', '', strtolower($nome));

                $medicos = Medico::select('id', 'nome', 'especialidade', 'cidade_id')
                    ->whereRaw('UPPER(nome) like ?', ["%".strtoupper($nome)."%"])
                    ->orderBy('nome')
                    ->get();
            } else {
                $medicos = Medico::select('id', 'nome', 'especialidade', 'cidade_id')
                    ->orderBy('nome')
                    ->get();
            }

            return $medicos;

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 500,
                'success' => false,
                'msg'     => 'Erro ao retornar médicos: ' . $e->getMessage(),
                'data'    => now()->format('Y-m-d H:i:s'),
            ], 500);
        }
    }

    public function showByCity($id_cidade, $nome = null)
    {
        try {

            $regras = ['id_cidade' => 'required|integer'];

            $mensagens = [
                'id_cidade.required' => 'O campo cidade é obrigatório.',
                'id_cidade.integer'  => 'O campo cidade deve ser um número inteiro.',
            ];

            $validador = Validator::make(['id_cidade' => $id_cidade], $regras, $mensagens);

            // Verifica se o parâmetro obrigatório foi informado;
            if ($validador->fails()) {
                return response()->json([
                    'status'  => 400,
                    'success' => false,
                    'msg'     => 'Erro de validação.',
                    'data'    => $validador->errors(),
                ], 400);
            }

            if ($nome) {
                // Removendo pontos, vírgulas e espaços da string;
                $nome = str_replace(['.', ',', ' '], '', $nome);
                // Remover os prefixos "dr" e "dra" da string;
                $nome = preg_replace('/^dr\s*|^dra\s*/i', '', strtolower($nome));

                $medicos = Medico::select('id', 'nome', 'especialidade', 'cidade_id')
                    ->where('cidade_id', $id_cidade)
                    ->whereRaw('UPPER(nome) like ?', ["%".strtoupper($nome)."%"])
                    ->orderBy('nome')
                    ->get();
            } else {
                $medicos = Medico::select('id', 'nome', 'especialidade', 'cidade_id')
                    ->where('cidade_id', $id_cidade)
                    ->orderBy('nome')
                    ->get();
            }

            return $medicos;

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 500,
                'success' => false,
                'msg'     => 'Erro ao retornar médicos: ' . $e->getMessage(),
                'data'    => now()->format('Y-m-d H:i:s'),
            ], 500);
        }
    }
}
