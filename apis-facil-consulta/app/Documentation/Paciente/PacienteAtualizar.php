<?php

namespace App\Documentation\Paciente;

/**
 * @OA\Put(
 *     path="/api/pacientes/{id_paciente}",
 *     tags={"Pacientes"},
 *     summary="Atualiza um paciente na base de dados",
 *     description="Atualiza um paciente na base de dados",
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id_paciente",
 *         in="path",
 *         description="ID do paciente",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"nome", "celular"},
 *             @OA\Property(
 *                 property="nome",
 *                 type="string",
 *                 description="Nome do paciente"
 *             ),
 *             @OA\Property(
 *                 property="celular",
 *                 type="string",
 *                 description="Celular do paciente"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Paciente atualizado com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="nome",
 *                 type="string",
 *                 description="Nome do paciente"
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
 *         response=404,
 *         description="Paciente não encontrado"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Erro interno do servidor"
 *     )
 * )
 */
