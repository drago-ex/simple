<?php

declare(strict_types = 1);

/**
 * Drago Single
 * Package built on Nette Framework
 */
namespace Single;

use Latte\Engine;
use Nette\Bridges\FormsLatte\FormMacros;
use Nette\Http\RequestFactory;
use Nette\SmartObject;
use Nette\Utils\FileSystem;


/**
 * Single web pages.
 * @package Drago\Single
 */
class Latte
{
	use SmartObject;

	/** @var string */
	private $temp;

	public function __construct(string $temp)
	{
		$this->temp  = $temp . '/_Latte.TemplateCache';
		if (!is_dir($this->temp)) {
			FileSystem::createDir($this->temp);
		}
	}


	/**
	 * Path to root.
	 */
	private function getBasePath(): string
	{
		$pathInfo = new RequestFactory;
		$basePath = rtrim($pathInfo->createHttpRequest()->url->basePath, '/');
		return $basePath;
	}


	/**
	 * Latte engine.
	 */
	private function createLatteEngine(): Engine
	{
		$latte = new Engine;
		$latte->setTempDirectory($this->temp);
		$latte->onCompile[] = function() use($latte) {
			FormMacros::install($latte->getCompiler());
		};
		return $latte;
	}


	/**
	 * Renders template to output.
	 */
	public function render(string $name, array $params = []):void
	{
		$latte = $this->createLatteEngine();
		$basePath = ['basePath' => $this->getBasePath()] ;
		$latte->render($name, $params + $basePath);
	}
}
