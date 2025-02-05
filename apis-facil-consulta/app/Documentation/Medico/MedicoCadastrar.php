<?php

namespace App\Documentation\Medico;

/**
 * @OA\Post(
 *     path="/api/medicos",
 *     tags={"Medicos"},
 *     summary="Cadastra um médico na base de dados",
 *     description="Cadastra um médico na base de dados",
 *     security={{"bearerAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"nome", "especialidade", "crm"},
 *             @OA\Property(
 *                 property="nome",
 *                 type="string",
 *                 description="Nome do médico"
 *             ),
 *             @OA\Property(
 *                 property="especialidade",
 *                 type="string",
 *                 description="Especialidade do médico"
 *             ),
 *             @OA\Property(
 *                 property="crm",
 *                 type="string",
 *                 description="CRM do médico"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Médico cadastrado com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="id",
 *                 type="integer",
 *                 description="ID do médico"
 *             ),
 *             @OA\Property(
 *                 property="nome",
 *                 type="string",
 *                 description="Nome do médico"
 *             ),
 *             @OA\Property(
 *                 property="especialidade",
 *                 type="string",
 *                 description="Especialidade do médico"
 *             ),
 *             @OA\Property(
 *                 property="crm",
 *                 type="string",
 *                 description="CRM do médico"
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
