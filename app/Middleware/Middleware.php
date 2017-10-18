<?php

namespace App\Middleware;

/**
* base Middleware
*/
class Middleware
{
	protected $container;
	
	function __construct($container)
	{
		$this->container = $container;
	}
}