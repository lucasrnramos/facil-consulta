<?php

namespace App\Documentation\Medico;

/**
 * @OA\Get(
 *     path="/api/medicos/{nome?}",
 *     tags={"Medicos"},
 *     summary="Retorna a lista de médicos",
 *     description="Retorna a lista de médicos, podendo filtrar por nome",
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="nome",
 *         in="path",
 *         description="Nome do médico",
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
 *                     description="ID do médico"
 *                 ),
 *                 @OA\Property(
 *                     property="nome",
 *                     type="string",
 *                     description="Nome do médico"
 *                 ),
 *                 @OA\Property(
 *                     property="especialidade",
 *                     type="string",
 *                     description="Especialidade do médico"
 *                 ),
 *                 @OA\Property(
 *                     property="cidade_id",
 *                     type="integer",
 *                     description="ID da cidade"
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Erro interno do servidor"
 *     )
 * )
 */
