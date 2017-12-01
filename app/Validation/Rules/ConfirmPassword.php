<?php

namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use App\Models\User;

/**
* custom password validation
*/
class ConfirmPassword extends AbstractRule
{
	protected $cPassword;

	function __construct($cPassword)
	{
		$this->cPassword = $cPassword;
	}

	public function validate ($input)
	{
		return $input === $this->cPassword;
	}
}