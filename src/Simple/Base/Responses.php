<?php

declare(strict_types = 1);

/**
 * Drago Extension
 * Package built on Nette Framework
 */

namespace Drago\Simple\Base;

use Nette;


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
		$response = new Nette\Http\Response;
		$response->redirect($url);
	}
}
