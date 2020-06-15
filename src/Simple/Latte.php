<?php

declare(strict_types = 1);

/**
 * Dago Extension
 * Package built on Nette Framework
 */

namespace Drago\Simple;

use Latte\Engine;
use Latte\Runtime\Template;
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
		return rtrim((new RequestFactory)
			->fromGlobals()->url->basePath, '/');
	}


	/**
	 * Creates template object.
	 */
	public function createTemplate(string $name, array $params = []): Template
	{
		$parameters = $params + ['basePath' => $this->basePath()];
		return parent::createTemplate($name, $parameters);
	}
}
