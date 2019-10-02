<?php

declare(strict_types = 1);

/**
 * Drago Extension
 * Package built on Nette Framework
 */

namespace Drago\Simple\Base;

use Nette\Http\Response;


/**
 * HttpResponse class.
 * @package Drago\Simple
 */
trait Responses
{
	public function response()
	{
		return new Response;
	}
}
