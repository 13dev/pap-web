<?php

namespace App\Middleware;

/**
* presists the input on form
*/
class OldInputMiddleware extends Middleware
{
	
	public function __invoke($request, $response, $next)
	{
		$this->container->view->getEnvironment()
				->addGlobal('oldInput', (isset($_SESSION['oldInput'])) ? $_SESSION['oldInput'] : null );
		$_SESSION['oldInput'] = $request->getParams();
		
		$response = $next($request, $response);
		return $response;
	}
}