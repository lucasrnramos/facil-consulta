<?php

namespace App\Documentation\Cidade;

/**
 * @OA\Get(
 *     path="/api/cidades/{nome?}",
 *     summary="Retorna uma lista de cidades",
 *     tags={"Cidade"},
 *     @OA\Parameter(
 *         name="nome",
 *         in="path",
 *         description="Nome da cidade",
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
 *                     description="ID da cidade"
 *                 ),
 *                 @OA\Property(
 *                     property="nome",
 *                     type="string",
 *                     description="Nome da cidade"
 *                 ),
 *                 @OA\Property(
 *                     property="estado",
 *                     type="string",
 *                     description="Estado da cidade"
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Nenhuma cidade encontrada"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Erro interno do servidor"
 *     )
 * )
 */
