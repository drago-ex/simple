<?php

/**
 * Drago Extension
 * Package built on Nette Framework
 */

declare(strict_types=1);

namespace Drago\Simple\Base;

use Nette\Http;


/**
 * Provides access to session sections as well as session settings and management methods.
 * @property string $message
 */
trait Session
{
	public function session(): Http\Session
	{
		$request = (new Http\RequestFactory)->fromGlobals();
		return new Http\Session($request, new Http\Response);
	}
}
