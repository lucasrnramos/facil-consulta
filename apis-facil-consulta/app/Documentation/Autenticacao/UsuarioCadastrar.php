<?php

namespace App\Documentation\Autenticacao;

/**
 * @OA\Post(
 *     path="/api/usuario/registrar",
 *     tags={"Auth"},
 *     summary="Registra um novo usuário",
 *     description="Registra um novo usuário na base de dados",
 *     security={{"bearerAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "email", "password"},
 *             @OA\Property(
 *                 property="name",
 *                 type="string",
 *                 description="Nome do usuário"
 *             ),
 *             @OA\Property(
 *                 property="email",
 *                 type="string",
 *                 format="email",
 *                 description="Email do usuário"
 *             ),
 *             @OA\Property(
 *                 property="password",
 *                 type="string",
 *                 description="Senha do usuário"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Usuário registrado com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="id",
 *                 type="integer",
 *                 description="ID do usuário"
 *             ),
 *             @OA\Property(
 *                 property="name",
 *                 type="string",
 *                 description="Nome do usuário"
 *             ),
 *             @OA\Property(
 *                 property="email",
 *                 type="string",
 *                 format="email",
 *                 description="Email do usuário"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Erro de validação"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Erro interno do servidor"
 *     )
 * )
 */
