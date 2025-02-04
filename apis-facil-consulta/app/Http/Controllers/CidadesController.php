<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cidade;

class CidadesController extends Controller
{
    public function show($nome = null)
    {
        try {

            if ($nome) {
                //Tratamento para fazer a consulta com case insensitive;
                $cidades = Cidade::select('id', 'nome', 'estado')
                    ->whereRaw('UPPER(nome) like ?', ["%".strtoupper($nome)."%"])
                    ->orderBy('nome')
                    ->get();
            } else {
                $cidades = Cidade::select('id', 'nome', 'estado')
                    ->orderBy('nome')
                    ->get();
            }

            return $cidades;

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
