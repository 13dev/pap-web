<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;


/**
* Password Controller
*/
class PasswordController extends Controller
{

	function getChangePassword($request, $response)
	{
		return $this->view->render($response, 'auth/password/change.twig');
	}

	function postChangePassword($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'password_old' => v::noWhitespace()->notEmpty()->matchesPassword($this->auth->user()->password),
			'password' => v::noWhitespace()->notEmpty(),
		]);

		if($validation->failed())
		{
			return $response->withRedirect($this->router->pathFor('auth.password.change'));
		}

		//set new password
		$this->auth->user()->setPassword($request->getParam('password'));

		$this->container->flash->addMessage('nav-success', 'Password changed successfuly.');
		return $response->withRedirect($this->router->pathFor('home'));
	}
}