<?php

declare(strict_types=1);

namespace Drago\Simple\Base;

use Nette\Http;


trait Session
{
	private ?Http\Session $httpSession = null;


	/** Returns the session, created from the current request on the first call. */
	public function session(): Http\Session
	{
		return $this->httpSession ??= new Http\Session(
			(new Http\RequestFactory)->fromGlobals(),
			new Http\Response,
		);
	}
}
