<?php

namespace App\Documentation\Cidade;

/**
 * @OA\Get(
 *     path="/api/cidades/{id_cidade}/medicos/{nome?}",
 *     tags={"Cidade"},
 *     summary="Retorna os médicos de uma cidade",
 *     description="Retorna os médicos de uma cidade",
 *     @OA\Parameter(
 *         name="id_cidade",
 *         in="path",
 *         description="ID da cidade",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
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
 *         response=404,
 *         description="Nenhum médico encontrado para a cidade"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Erro interno do servidor"
 *     )
 * )
 */
