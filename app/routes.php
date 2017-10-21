<?php

/**
 * Routes
 */

$app->get('/', 'HomeController:index')->setName('home');

//Auth
$app->group('/auth', function () {
	//signup
	$this->get('/signup', 'AuthController:getSignUp')->setName('auth.signup');
	$this->post('/signup', 'AuthController:postSignUp');

	//signin
	$this->get('/signin', 'AuthController:getSignIn')->setName('auth.signin');
	$this->post('/signin', 'AuthController:postSignIn');

	//signout
	$this->get('/signout', 'AuthController:getSignOut')->setName('auth.signout');

	//Change password
	$this->get('/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
	$this->post('/password/change', 'PasswordController:postChangePassword');
});