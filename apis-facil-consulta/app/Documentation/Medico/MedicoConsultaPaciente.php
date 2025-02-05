<?php

namespace App\Documentation\Medico;

/**
 * @OA\Get(
 *     path="/api/medicos/{id_medico}/pacientes/{apenas_agendadas?}/{nome?}",
 *     tags={"Medicos"},
 *     summary="Retorna as consultas de um médico",
 *     description="Retorna as consultas de um médico, podendo filtrar por consultas agendadas e nome do paciente",
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id_medico",
 *         in="path",
 *         description="ID do médico",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="apenas_agendadas",
 *         in="path",
 *         description="Filtra apenas consultas agendadas",
 *         required=false,
 *         @OA\Schema(
 *             type="boolean"
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="nome",
 *         in="path",
 *         description="Nome do paciente",
 *         required=false,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Sucesso",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(
 *                     property="id",
 *                     type="integer",
 *                     description="ID do paciente"
 *                 ),
 *                 @OA\Property(
 *                     property="nome",
 *                     type="string",
 *                     description="Nome do paciente"
 *                 ),
 *                 @OA\Property(
 *                     property="cpf",
 *                     type="string",
 *                     description="CPF do paciente"
 *                 ),
 *                 @OA\Property(
 *                     property="celular",
 *                     type="string",
 *                     description="Celular do paciente"
 *                 ),
 *                 @OA\Property(
 *                     property="consulta",
 *                     type="object",
 *                     @OA\Property(
 *                         property="id",
 *                         type="integer",
 *                         description="ID da consulta"
 *                     ),
 *                     @OA\Property(
 *                         property="data",
 *                         type="string",
 *                         format="date-time",
 *                         description="Data da consulta"
 *                     ),
 *                     @OA\Property(
 *                         property="created_at",
 *                         type="string",
 *                         format="date-time",
 *                         description="Data de criação"
 *                     ),
 *                     @OA\Property(
 *                         property="updated_at",
 *                         type="string",
 *                         format="date-time",
 *                         description="Data de atualização"
 *                     ),
 *                     @OA\Property(
 *                         property="deleted_at",
 *                         type="string",
 *                         format="date-time",
 *                         description="Data de exclusão"
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Erro de validação"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Nenhuma consulta encontrada"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Erro interno do servidor"
 *     )
 * )
 */
