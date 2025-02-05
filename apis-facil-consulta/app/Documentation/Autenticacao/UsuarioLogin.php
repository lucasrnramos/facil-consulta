<?php

namespace App\Documentation\Autenticacao;

/**
 * @OA\Post(
 *     path="/api/usuario/login",
 *     tags={"Auth"},
 *     summary="Realiza o login de um usuário",
 *     description="Realiza o login de um usuário e retorna um token JWT",
 *     security={{"bearerAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"email", "password"},
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
 *         response=200,
 *         description="Login realizado com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="access_token",
 *                 type="string",
 *                 description="Token de acesso"
 *             ),
 *             @OA\Property(
 *                 property="token_type",
 *                 type="string",
 *                 description="Tipo do token"
 *             ),
 *             @OA\Property(
 *                 property="expires_in",
 *                 type="integer",
 *                 description="Tempo de expiração do token em segundos"
 *             ),
 *             @OA\Property(
 *                 property="user",
 *                 type="object",
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
 *         response=401,
 *         description="Login e/ou senha inválidos"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Erro interno do servidor"
 *     )
 * )
 */
