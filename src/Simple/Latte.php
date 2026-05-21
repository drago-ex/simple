<?php

declare(strict_types=1);

namespace Drago\Simple;

use Latte\Engine;
use Latte\Runtime\Template;
use Nette\Http\RequestFactory;


/** Custom Latte engine with automatic base path injection into templates. */
class Latte extends Engine
{
	private function basePath(): string
	{
		return rtrim((new RequestFactory)
			->fromGlobals()->url->basePath, '/');
	}


	/**
	 * @param array<string, mixed> $params
	 */
	public function createTemplate(string $name, array $params = [], bool $clearCache = true): Template
	{
		$parameters = $params + ['basePath' => $this->basePath()];
		return parent::createTemplate($name, $parameters);
	}
}
