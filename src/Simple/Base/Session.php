<?php

declare(strict_types=1);

namespace Drago\Simple\Base;

use Nette\Http;


/** Trait for managing the session instance. */
trait Session
{
	public function session(): Http\Session
	{
		$request = (new Http\RequestFactory)->fromGlobals();
		return new Http\Session($request, new Http\Response);
	}
}
