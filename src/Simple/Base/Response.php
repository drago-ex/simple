<?php

/**
 * Drago Extension
 * Package built on Nette Framework
 */

declare(strict_types=1);

namespace Drago\Simple\Base;

use Nette\Http;


/**
 * Trait for handling HTTP responses.
 */
trait Response
{
	/**
	 * Redirects to a specified URL with an optional HTTP status code.
	 */
	public function redirect(string $url, int $code = Http\IResponse::S302_Found): void
	{
		$response = new Http\Response;
		$response->redirect($url, $code);
	}
}
