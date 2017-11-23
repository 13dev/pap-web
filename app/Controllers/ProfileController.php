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
		if(!User::where('username', $args['username'])->exists()){
			return $this->view->render($response, 'error/404.twig');
		}

		$user = User::where('username', $args['username'])->first();


		$questions = $user->questions()->get();

		return $this->view->render($response, 'profile/get.twig', [
		    'user' => $user,
            'questions' => $questions,
        ]);
	}
}