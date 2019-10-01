<?php

declare(strict_types = 1);

/**
 * Dago Extension
 * Package built on Nette Framework
 */
namespace Drago\Simple;

use Latte\Engine;
use Latte\Runtime;
use Nette\Http\RequestFactory;


/**
 * Templating engine Latte.
 */
class Latte extends Engine
{
	/**
	 * Base path in template.
	 */
	private function basePath(): string
	{
		return rtrim(
			(new RequestFactory)->createHttpRequest()
				->url->basePath, '/'
		);
	}


	/**
	 * Creates template object.
	 */
	public function createTemplate(string $name, array $params = []): Runtime\Template
	{
		return parent::createTemplate($name,
			$params + ['basePath' => $this->basePath()]
		);
	}
}
