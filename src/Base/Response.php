<?php

declare(strict_types=1);

namespace Drago\Simple\Base;

use Nette\Http;


/** Trait for handling HTTP redirects. */
trait Response
{
	/** Sends the redirect and stops the script, so nothing is rendered after it. */
	public function redirect(string $url, int $code = Http\IResponse::S302_Found): void
	{
		$response = new Http\Response;
		$response->redirect($url, $code);
		$this->terminate();
	}


	protected function terminate(): void
	{
		exit;
	}
}
