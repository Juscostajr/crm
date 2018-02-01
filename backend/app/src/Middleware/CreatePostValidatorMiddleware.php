<?php

namespace App\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

class CreatePostValidatorMiddleware {

    public function __invoke(Request $request, Response $response, $next)
    {
        $jsonValidator = new \JsonSchema\Validator();

        try {
            $jsonSchemaObject = json_decode(
                file_get_contents(__DIR__ . '/../Schema/create_post.json')
            );

            $jsonToValidateObject = json_decode($request->getBody()->getContents());

            $jsonValidator->validate($jsonToValidateObject, $jsonSchemaObject);
            
            if (!$jsonValidator->isValid()){
                throw new \Exception();
            }
            
            $response = $next($request, $response);
            
            return $response;
        } catch (\Exception $ex) {
            return $response->withJson($jsonValidator->getErrors())->withStatus(400);
        }
    }
}
