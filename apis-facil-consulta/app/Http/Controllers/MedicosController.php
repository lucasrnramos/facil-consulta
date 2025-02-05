<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Models\Consulta;
use App\Models\Paciente;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request): JsonResponse
    {
        try {

            $regras = [
                "medico_id"   => "required|integer",
                "paciente_id" => "required|integer",
                "data"        => "required|date",
            ];

            $mensagens = [
                'medico_id.required'   => 'O campo médico é obrigatório.',
                'medico_id.integer'    => 'O campo médico deve ser um número inteiro.',
                'paciente_id.required' => 'O campo paciente é obrigatório.',
                'paciente_id.integer'  => 'O campo paciente deve ser um número inteiro.',
                'data.required'        => 'O campo data é obrigatório.',
                'data.dateTimeStamp'   => 'O campo data deve ser uma data válida.',
            ];

            $validador = Validator::make($request->all(), $regras, $mensagens);

            // Verifica se os campos obrigatórios foram informados;
            if ($validador->fails()) {
                return response()->json([
                    'status'  => 400,
                    'success' => false,
                    'msg'     => 'Erro de validação.',
                    'data'    => $validador->errors(),
                ], 400);
            }

            $consulta = new Consulta();
            $consulta->medico_id   = $request->medico_id;
            $consulta->paciente_id = $request->paciente_id;
            $consulta->data        = $request->data;

            if ($consulta->save())  {
                return response()->json([
                        'id'          => $consulta->id,
                        'medico_id'   => $consulta->medico_id,
                        'paciente_id' => $consulta->paciente_id,
                        'data'        => $consulta->data,
                        'created_at'  => $consulta->created_at,
                        'updated_at'  => $consulta->updated_at,
                        'deleted_at'  => $consulta->deleted_at
                ], 200);
            }  else {
                return response()->json([
                    'status'  => 500,
                    'success' => false,
                    'msg'     => 'Erro ao salvar a consulta.',
                ], 500);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 500,
                'success' => false,
                'msg'     => 'Erro ao agendar consulta: ' . $e->getMessage(),
                'data'    => now()->format('Y-m-d H:i:s'),
            ], 500);
        }
    }

    public function showByPatient($id_medico, $apenas_agendadas = null, $nome = null)
    {
        try {

            $regras = [
                "id_medico" => "required|integer",
            ];

            $mensagens = [
                'id_medico.required' => 'O campo médico é obrigatório.',
                'id_medico.integer'  => 'O campo médico deve ser um número inteiro.',
            ];

            $validador = Validator::make(['id_medico' => $id_medico], $regras, $mensagens);

            // Verifica se o parâmetro obrigatório foi informado;
            if ($validador->fails()) {
                return response()->json([
                    'status'  => 400,
                    'success' => false,
                    'msg'     => 'Erro de validação.',
                    'data'    => $validador->errors(),
                ], 400);
            }

            if ($apenas_agendadas == true) {
                $consultas = Consulta::select(
                    'pacientes.id as id_paciente',
                    'pacientes.nome',
                    'pacientes.cpf',
                    'pacientes.celular',
                    'pacientes.created_at',
                    'pacientes.updated_at',
                    'pacientes.deleted_at',
                    'consultas.id as id_consulta',
                    'consultas.data',
                    'consultas.created_at',
                    'consultas.updated_at',
                    'consultas.deleted_at',
                )
                    ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id')
                    ->where('consultas.medico_id', $id_medico)
                    ->where('consultas.data', '>', DB::raw('SYSDATE()'));

                     if ($nome) {
                         // Removendo pontos, vírgulas da string;
                         $nome = str_replace(['.', ','], '', $nome);
                         $consultas->whereRaw('UPPER(pacientes.nome) like ?', ["%".strtoupper($nome)."%"]);
                     }

                $consultas = $consultas->orderBy('consultas.data')->get();
            } else {
                $consultas = Consulta::select(
                    'pacientes.id as id_paciente',
                    'pacientes.nome',
                    'pacientes.cpf',
                    'pacientes.celular',
                    'pacientes.created_at',
                    'pacientes.updated_at',
                    'pacientes.deleted_at',
                    'consultas.id as id_consulta',
                    'consultas.data',
                    'consultas.created_at',
                    'consultas.updated_at',
                    'consultas.deleted_at'
                )
                    ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id')
                    ->where('consultas.medico_id', $id_medico);

                if ($nome) {
                    // Removendo pontos, vírgulas da string;
                    $nome = str_replace(['.', ','], '', $nome);
                    $consultas->whereRaw('UPPER(pacientes.nome) like ?', ["%".strtoupper($nome)."%"]);
                }

                $consultas = $consultas->orderBy('consultas.data')->get();

            }

            if ($consultas->isEmpty()) {
                return response()->json([
                    'status'  => 404,
                    'success' => false,
                    'msg'     => 'Nenhuma consulta encontrada.',
                    'data'    => now()->format('Y-m-d H:i:s'),
                ], 404);
            }

            $result = $consultas->map(function ($consulta) {
                return [
                    'id'   => $consulta->id_paciente,
                    'nome' => $consulta->nome,
                    'cpf'  => $consulta->cpf,
                    'celular'    => $consulta->celular,
                    'created_at' => $consulta->created_at,
                    'updated_at' => $consulta->updated_at,
                    'deleted_at' => $consulta->deleted_at,
                    'consulta' => [
                        'id'   => $consulta->id_consulta,
                        'data' => $consulta->data,
                        'created_at' => $consulta->created_at,
                        'updated_at' => $consulta->updated_at,
                        'deleted_at' => $consulta->deleted_at,
                    ]
                ];
            });

            return response()->json($result);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 500,
                'success' => false,
                'msg'     => 'Erro ao retornar consultas: ' . $e->getMessage(),
                'data'    => now()->format('Y-m-d H:i:s'),
            ], 500);
        }
    }

    public function storeByMedical(Request $request): JsonResponse
    {
        try {

            $regras = [
                "nome"          => "required|string",
                "especialidade" => "required|string",
                "cidade_id"     => "required|integer",
            ];

            $mensagens = [
                'nome.required'          => 'O campo nome é obrigatório.',
                'nome.string'            => 'O campo nome deve ser uma string.',
                'especialidade.required' => 'O campo especialidade é obrigatório.',
                'especialidade.string'   => 'O campo especialidade deve ser uma string.',
                'cidade_id.required'     => 'O campo cidade é obrigatório.',
                'cidade_id.integer'      => 'O campo cidade deve ser um número inteiro.',
            ];

            $validador = Validator::make($request->all(), $regras, $mensagens);

            // Verifica se os campos obrigatórios foram informados;
            if ($validador->fails()) {
                return response()->json([
                    'status'  => 400,
                    'success' => false,
                    'msg'     => 'Erro de validação.',
                    'data'    => $validador->errors(),
                ], 400);
            }

            $medico = new Medico();
            $medico->nome          = $request->post('nome');
            $medico->especialidade = $request->post('especialidade');
            $medico->cidade_id     = $request->post('cidade_id');

            if ($medico->save()) {
                return response()->json([
                    'id'          => $medico->id,
                    'nome'        => $medico->nome,
                    'especialidade' => $medico->especialidade,
                    'cidade_id'   => $medico->cidade_id,
                    'created_at'  => $medico->created_at,
                    'updated_at'  => $medico->updated_at,
                    'deleted_at'  => $medico->deleted_at
                ], 200);
            } else {
                return response()->json([
                    'status'  => 500,
                    'success' => false,
                    'msg'     => 'Erro ao salvar médico.',
                ], 500);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 500,
                'success' => false,
                'msg'     => 'Erro ao salvar médico: ' . $e->getMessage(),
                'data'    => now()->format('Y-m-d H:i:s'),
            ], 500);
        }
    }
}
