<?php

namespace App\Documentation\Paciente;

/**
 * @OA\Post(
 *     path="/api/pacientes",
 *     tags={"Pacientes"},
 *     summary="Cadastra um paciente na base de dados",
 *     description="Cadastra um paciente na base de dados",
 *     security={{"bearerAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"nome", "cpf", "celular"},
 *             @OA\Property(
 *                 property="nome",
 *                 type="string",
 *                 description="Nome do paciente"
 *             ),
 *             @OA\Property(
 *                 property="cpf",
 *                 type="string",
 *                 description="CPF do paciente"
 *             ),
 *             @OA\Property(
 *                 property="celular",
 *                 type="string",
 *                 description="Celular do paciente"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Paciente cadastrado com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="nome",
 *                 type="string",
 *                 description="Nome do paciente"
 *             ),
 *             @OA\Property(
 *                 property="cpf",
 *                 type="string",
 *                 description="CPF do paciente"
 *             ),
 *             @OA\Property(
 *                 property="celular",
 *                 type="string",
 *                 description="Celular do paciente"
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
