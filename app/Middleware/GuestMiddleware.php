<?php

namespace App\Middleware;

/**
 * Protect routes
 */
class GuestMiddleware extends Middleware
{

    public function __invoke($request, $response, $next)
    {
        if ($this->container->auth->check()) {
            //$this->container->flash->addMessage('nav-error', 'Não podes aceder a esta área.');
            return $response->withRedirect($this->container->router->pathFor('home'));
        }

        $response = $next($request, $response);
        return $response;
    }
}
