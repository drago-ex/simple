<?php

declare(strict_types = 1);

/**
 * Drago Extension
 * Package built on Nette Framework
 */
namespace Drago\Simple\Component;

use Drago\Simple\Base\Responses;


/**
 * Redirects to a new URL.
 */
trait Redirect
{
	use Responses;

	/**
	 * Http redirect.
	 */
	public function redirect(string $url): void
	{
		$response = $this->response();
		$response->redirect($url);
	}
}
