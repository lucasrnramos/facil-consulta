<?php

namespace App\Documentation;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         title="Nome do projeto",
 *         version="1.0.0"
 *     ),
 *     @OA\Server(
 *         url="http://127.0.0.1:8000",
 *         description="Servidor de produção"
 *     ),
 *     @OA\Server(
 *         url="http://127.0.0.1:8000",
 *         description="Servidor de homologação"
 *     ),
 *     @OA\Components(
 *         @OA\SecurityScheme(
 *             type="http",
 *             securityScheme="bearerAuth",
 *             scheme="bearer",
 *             bearerFormat="JWT"
 *         ),
 *         @OA\Tag(
 *             name="TAG_NAME",
 *             description="Use esse espaço para lsitar as tags do projeto."
 *         )
 *     )
 * )
 */

class SwaggerDocumentation
{

}
