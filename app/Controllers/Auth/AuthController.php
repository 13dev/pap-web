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

	function getSignOut($request, $response)
	{
		$this->auth->logout();

		$this->container->flash->addMessage('nav-info', 'Esperamos te ver por ai!');

		return $response->withRedirect($this->router->pathFor('home'));
	}

	function getSignIn($request, $response)
	{
		//return the view
		return $this->view->render($response, 'auth/signin.twig');
	}

	function postSignIn($request, $response)
	{
		$auth = $this->auth->attempt(
			$request->getParam('email'),
			$request->getParam('password')
		);

		if(!$auth){
			$this->container->flash->addMessage('nav-error', 'Could not sign you in with those details.');
			return $response->withRedirect($this->router->pathFor('auth.signin'));
		}

		$this->container->flash->addMessage('nav-info', 'Bem-vindo!');

		return $response->withRedirect($this->router->pathFor('home'));
	}

	function getSignUp($request, $response)
	{
		//return the view
		return $this->view->render($response, 'auth/signup.twig');
	}

	function postSignUp($request, $response)
	{
		//Let's verify inputs
		$validation = $this->validator->validate($request, [
			'email' => v::noWhitespace()->notEmpty()->emailAvailable()->email(),
			'firstname' => v::notEmpty()->Alpha(),
			'lastname' => v::notEmpty()->Alpha(),
			'confirm_password' => v::noWhitespace()->notEmpty()->confirmPassword($request->getParam('password')),
			'password' => v::noWhitespace()->notEmpty(),
			'username' => v::notEmpty()->regex('/[^a-z\_.]/')->usernameAvailable()->length(1, 15),
		]);

		if($validation->failed()){
			//Auth Failed the Validation
			return $response->withRedirect($this->router->pathFor('auth.signup'));
		}

		//Nice passed validator!
		//Creating user...
		$user = User::create([
			'email' =>  $request->getParam('email'),
			'firstname' => ucfirst(strtolower($request->getParam('firstname'))),
			'lastname' => ucfirst(strtolower($request->getParam('lastname'))),
			'username' => $request->getParam('username'),
			'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
		]);

        $this->container->flash->addMessage('nav-info', 'Account created.');
		return $response
				->withRedirect($this->router->pathFor('home'));
	}
}