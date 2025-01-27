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
	/** @readonly */
	private string $basePath;

	private RequestFactory $requestFactory;


	/**
	 * Initializes the engine with the RequestFactory instance.
	 */
	public function __construct(RequestFactory $requestFactory)
	{
		parent::__construct();
		$this->requestFactory = $requestFactory;
		$this->basePath = $this->calculateBasePath();
	}


	/**
	 * Calculates and returns the base path (without trailing slashes).
	 */
	private function calculateBasePath(): string
	{
		return rtrim($this->requestFactory->fromGlobals()->url->basePath, '/');
	}


	/**
	 * Returns the cached base path.
	 */
	public function getBasePath(): string
	{
		return $this->basePath;
	}


	/**
	 * Creates a template with the base path and additional parameters.
	 */
	public function createTemplate(string $name, array $params = [], $clearCache = true): Template
	{
		$parameters = $params + ['basePath' => $this->getBasePath()];
		return parent::createTemplate($name, $parameters);
	}
}
