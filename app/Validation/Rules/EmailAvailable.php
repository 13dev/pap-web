<?php

namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use App\Models\User;
/**
* custom email validation
*/
class EmailAvailable extends AbstractRule
{
	public function validate ($input)
	{
		return !User::where('email', $input)->exists();
	}
}