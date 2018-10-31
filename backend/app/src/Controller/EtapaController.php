<?php
/**
 * Created by PhpStorm.
 * User: Juscelino Jr
 * Date: 10/06/2018
 * Time: 14:44
 */

namespace App\Controller;


use App\Entity\Etapa;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class EtapaController
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getAll(Request $request, Response $response)
    {
        try {
            return $response->withJSON(Etapa::getAll());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

}