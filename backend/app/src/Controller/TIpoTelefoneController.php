<?php
/**
 * Created by PhpStorm.
 * User: Juscelino Jr
 * Date: 10/06/2018
 * Time: 14:44
 */

namespace App\Controller;


use App\Entity\TipoTelefone;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class TIpoTelefoneController
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getAll(Request $request, Response $response)
    {
        try {
            return $response->withJSON(TipoTelefone::getAll());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

}