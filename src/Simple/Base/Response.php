<?php

declare(strict_types=1);

/**
 * Drago Extension
 * Package built on Nette Framework
 */

namespace Drago\Simple\Base;

use Nette\Http;


/**
 * Http response.
 */
trait Response
{
	/**
	 * Redirects to a new URL.
	 */
	public function redirect(string $url, int $code = Http\Response::S302_FOUND): void
	{
		$response = new Http\Response;
		$response->redirect($url, $code);
	}
}
