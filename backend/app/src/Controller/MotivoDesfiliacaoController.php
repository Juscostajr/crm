<?php
/**
 * Created by PhpStorm.
 * User: Juscelino Jr
 * Date: 15/11/2018
 * Time: 08:48
 */

namespace App\Controller;


use App\Entity\MotivoDesfiliacao;
use App\Entity\TipoTelefone;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class MotivoDesfiliacaoController
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getAll(Request $request, Response $response)
    {
        $motivo = new MotivoDesfiliacao();
        try {
            return $response->withJSON($motivo->getAll());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

}