<?php

namespace App\Documentation\Autenticacao;

/**
 * @OA\Get(
 *     path="/api/user",
 *     tags={"Usuarios"},
 *     summary="Retorna a lista de usuários",
 *     description="Retorna a lista de usuários cadastrados no sistema",
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="Sucesso",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(
 *                     property="id",
 *                     type="integer",
 *                     description="ID do usuário"
 *                 ),
 *                 @OA\Property(
 *                     property="name",
 *                     type="string",
 *                     description="Nome do usuário"
 *                 ),
 *                 @OA\Property(
 *                     property="email",
 *                     type="string",
 *                     format="email",
 *                     description="Email do usuário"
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Nenhum usuário encontrado"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Erro interno do servidor"
 *     )
 * )
 */
