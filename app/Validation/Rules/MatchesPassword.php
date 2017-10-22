<?php

namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use App\Models\User;

/**
* custom email validation
*/
class MatchesPassword extends AbstractRule
{
	protected $password;

	function __construct($password)
	{
		$this->password = $password;
	}

	public function validate ($input)
	{
		return password_verify($input, $this->password);
	}
}