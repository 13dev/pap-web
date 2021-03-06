<?php

namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use App\Models\User;

/**
* unique username validation
*/
class UsernameAvailable extends AbstractRule
{
	public function validate ($input)
	{
		return !User::where('username', $input)->exists();
	}
}