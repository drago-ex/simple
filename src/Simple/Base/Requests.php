<?php

declare(strict_types = 1);

/**
 * Drago Extension
 * Package built on Nette Framework
 */

namespace Drago\Simple\Base;

use Nette\Http\Request;
use Nette\Http\RequestFactory;


/**
 * HTTP request.
 * @package Drago\Simple
 */
trait Requests
{
	/**
	 * Current HTTP request factory.
	 */
	public function requestFactory(): RequestFactory
	{
		return new RequestFactory;
	}


	/**
	 * Current HttpRequest object.
	 */
	public function httpRequest(): Request
	{
		return $this->requestFactory()
			->createHttpRequest();
	}
}
