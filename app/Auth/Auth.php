<?php

namespace App\Auth;

use App\Models\User;

/**
* Helper class to manage authetication
*/
class Auth
{

	/**
	 * return user object by session
	 * @return object user obj.
	 */
	public function user() 
	{
		if($this->check()){
			return User::find($_SESSION['user']);
		}

		return null;
	}

	/**
	 * Check if user is login
	 * @return boolean
	 */
	public function check()
	{
		return isset($_SESSION['user']);
	}

	public function attempt($email, $password)
	{
		$user = User::where('email', '=', $email)->first();

		if(!$user){
			return false;
		}

		if(password_verify($password, $user->password)){
			$_SESSION['user'] = $user->id;
			return true;
		}

		return false;
	}

	public function logout() 
	{
		unset($_SESSION['user']);
	}
}