<?php

declare(strict_types = 1);

/**
 * Drago Extension
 * Package built on Nette Framework
 */

namespace Drago\Simple\Base;

use Nette\Http\RequestFactory;
use Nette\Http\Response;
use Nette\Http\Session;


/**
 * Provides access to session sections as well as session settings and management methods.
 */
trait Sessions
{
	public function session(): Session
	{
		$request = (new RequestFactory)->createHttpRequest();
		return new Session($request, new Response);
	}
}
