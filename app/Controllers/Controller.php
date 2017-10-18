<?php

namespace App\Controllers;

/**
* Base Controller
*/
class Controller
{
	protected $container;

	function __construct($container)
	{
		$this->container = $container;
	}

	/**
	 * Magik method to avoid use container->
	 */
	function __get($prop){

		if($this->container->{$prop}){
			return $this->container->{$prop};
		}

	}
}