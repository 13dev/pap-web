<?php

namespace App\Middleware;

/**
* base Middleware
*/
class Middleware
{
	protected $container;

	public function __construct($container)
	{
		$this->container = $container;
	}
}