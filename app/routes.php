<?php
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
/**
 * Routes
 */

$app->get('/', 'HomeController:index')->setName('home');

//Auth
$app->group('/auth', function () use($container) {

	$this->group('', function () {
		//signup
		$this->get('/signup', 'AuthController:getSignUp')->setName('auth.signup');
		$this->post('/signup', 'AuthController:postSignUp');

		//signin
		$this->get('/signin', 'AuthController:getSignIn')->setName('auth.signin');
		$this->post('/signin', 'AuthController:postSignIn');

	})->add(new GuestMiddleware($container));

	$this->group('', function () {
		//signout
		$this->get('/signout', 'AuthController:getSignOut')->setName('auth.signout');

		//Change password
		$this->get('/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
		$this->post('/password/change', 'PasswordController:postChangePassword');

	})->add(new AuthMiddleware($container));

});

$app->group('/p', function () use($container) {

	$this->get('/{id:[0-9]+}', 'ProfileController:getProfile')->setName('profile.get');

});