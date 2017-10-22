<?php

namespace App\Controllers;

use App\Models\User;

/**
* Profile of user
*/
class ProfileController extends Controller
{

	function getProfile($request, $response, $args)
	{
		if(!User::where('id', $args['id'])->exists()){
			return $this->view->render($response, 'error/404.twig');
		}

		$user = User::find($args['id']);

		return $this->view->render($response, 'profile/get.twig', [ 'user' => $user ]);
	}
}