<?php

namespace App\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;
use Monolog\Logger;

class LogMiddleware {

    /**
     * @var Logger 
     */
    private $logger;
    
    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }
    
    public function __invoke(Request $request, Response $response, $next)
    {
        $this->logger->info($this->getRequestData($request));

        $response = $next($request, $response);

        $this->logger->info($response->getBody()->__toString());
        
        return $response;
    }
    
    private function getRequestData(Request $request)
    {
        if ($request->isGet() || $request->isDelete()) {
            return json_encode($request->getQueryParams());
        }
        
        if ($request->isPost() || $request->isPut()) {
            return json_encode($request->getParsedBody());
        }
    }
}
