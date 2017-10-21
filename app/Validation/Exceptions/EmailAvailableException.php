<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

/**
* Custom Exception for the email available
*/
class EmailAvailableException extends ValidationException
{
	public static $defaultTemplates = [
		self::MODE_DEFAULT => [
			self::STANDARD => 'Email is already taken.',
		],
	];
}