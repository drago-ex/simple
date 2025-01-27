<?php

/**
 * Drago Extension
 * Package built on Nette Framework
 */

declare(strict_types=1);

namespace Drago\Simple;

use Latte\Engine;
use Latte\Runtime\Template;
use Nette\Http\RequestFactory;


/**
 * Custom Latte engine with base path calculation.
 * Extends Latte\Engine to add base path handling and optimize performance.
 * Optimized for PHP 8.3 features like constructor property promotion and readonly properties.
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
	 * Creates a template with the base path and additional parameters.
	 */
	public function createTemplate(string $name, array $params = [], $clearCache = true): Template
	{
		$parameters = $params + ['basePath' => $this->basePath()];
		return parent::createTemplate($name, $parameters);
	}
}
