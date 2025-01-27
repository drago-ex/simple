<?php

/**
 * Drago Extension
 * Package built on Nette Framework
 */

declare(strict_types=1);

namespace Drago\Simple\Base;

use Nette\Http;


/**
 * Trait for managing session sections and settings.
 */
trait Session
{
	/**
	 * Returns the session instance.
	 */
	public function session(): Http\Session
	{
		$request = (new Http\RequestFactory)->fromGlobals();
		return new Http\Session($request, new Http\Response);
	}
}
