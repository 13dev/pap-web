<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;


/**
* Sign Up
*/
class AuthController extends Controller
{

	function getSignUp($request, $response)
	{
		//return the view
		return $this->view->render($response, 'auth/signup.twig');
	}

	function postSignUp($request, $response)
	{
		//Let's verify inputs
		$validation = $this->validator->validate($request, [
			'email' => v::noWhitespace()->notEmpty(),
			'name' => v::notEmpty(),
			'password' => v::notEmpty()
		]);

		if($validation->failed()){
			//Auth Failed the Validation
			return $response->withRedirect($this->router->pathFor('auth.signup'));
		}

		//Nice passed validator!
		$user = User::create([
			'name' => $request->getParam('name'),
			'email' => $request->getParam('email'),
			'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
		]);

		return $response
				->withRedirect($this->router->pathFor('home'));
	}
}