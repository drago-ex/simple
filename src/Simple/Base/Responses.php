<?php

declare(strict_types = 1);

/**
 * Drago Extension
 * Package built on Nette Framework
 */

namespace Drago\Simple\Base;

use Nette\Http\Response;


/**
 * Http response.
 */
trait Responses
{
	/**
	 * Redirects to a new URL.
	 */
	public function redirect(string $url): void
	{
		$response = new Response;
		$response->redirect($url);
	}
}
