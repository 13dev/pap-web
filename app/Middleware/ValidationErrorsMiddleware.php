<?php

namespace App\Middleware;

/**
* Verify if class Validation (input) have errors
* Grab the errors to view by session
*/
class ValidationErrorsMiddleware extends Middleware
{
	
	public function __invoke($request, $response, $next)
	{
		$this->container->view->getEnvironment()
				->addGlobal('validationErrors', (isset($_SESSION['validationErrors'])) ? $_SESSION['validationErrors'] : null );
		unset($_SESSION['validationErrors']);
		
		$response = $next($request, $response);
		return $response;
	}
}