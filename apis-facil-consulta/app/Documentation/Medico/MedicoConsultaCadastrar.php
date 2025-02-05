<?php

namespace App\Documentation\Medico;

/**
 * @OA\Post(
 *     path="/api/medicos/consulta",
 *     tags={"Medicos"},
 *     summary="Cadastra uma consulta na base de dados",
 *     description="Cadastra uma consulta na base de dados",
 *     security={{"bearerAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"medico_id", "paciente_id", "data"},
 *             @OA\Property(
 *                 property="medico_id",
 *                 type="integer",
 *                 description="ID do médico"
 *             ),
 *             @OA\Property(
 *                 property="paciente_id",
 *                 type="integer",
 *                 description="ID do paciente"
 *             ),
 *             @OA\Property(
 *                 property="data",
 *                 type="string",
 *                 format="date-time",
 *                 description="Data da consulta"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Consulta cadastrada com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="id",
 *                 type="integer",
 *                 description="ID da consulta"
 *             ),
 *             @OA\Property(
 *                 property="medico_id",
 *                 type="integer",
 *                 description="ID do médico"
 *             ),
 *             @OA\Property(
 *                 property="paciente_id",
 *                 type="integer",
 *                 description="ID do paciente"
 *             ),
 *             @OA\Property(
 *                 property="data",
 *                 type="string",
 *                 format="date-time",
 *                 description="Data da consulta"
 *             ),
 *             @OA\Property(
 *                 property="created_at",
 *                 type="string",
 *                 format="date-time",
 *                 description="Data de criação"
 *             ),
 *             @OA\Property(
 *                 property="updated_at",
 *                 type="string",
 *                 format="date-time",
 *                 description="Data de atualização"
 *             ),
 *             @OA\Property(
 *                 property="deleted_at",
 *                 type="string",
 *                 format="date-time",
 *                 description="Data de exclusão"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Erro de validação"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Não autorizado"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Erro interno do servidor"
 *     )
 * )
 */
