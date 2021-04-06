<?php

declare(strict_types=1);

/**
 * Drago Extension
 * Package built on Nette Framework
 */

namespace Drago\Simple\Base;

use Nette\Http;


/**
 * Provides access to session sections as well as session settings and management methods.
 */
trait Session
{
	public function session(): Http\Session
	{
		$request = (new Http\RequestFactory)->fromGlobals();
		return new Http\Session($request, new Http\Response);
	}
}
