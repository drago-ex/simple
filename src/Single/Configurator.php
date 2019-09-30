<?php

declare(strict_types = 1);

/**
 * Drago Single
 * Package built on Nette Framework
 */
namespace Single;

use Nette\Loaders\RobotLoader;
use Nette\SmartObject;
use Tracy\Debugger;


/**
 * Single web pages.
 * @package Drago\Single
 */
class Configurator
{
	use SmartObject;

	const
		DEVELOPMENT = false,
		PRODUCTION  = true;

	/** @var string */
	private $temp;

	/** @var mixed */
	private $mode;

	public function __construct(string $temp, $mode = null)
	{
		$this->temp = $temp;
		$this->mode = $mode;
	}


	/**
	 * Enable Tracy tools
	 * @param string|array $email
	 */
	public function enableTracy(string $logDirectory = null, $email = null): void
	{
		Debugger::$strictMode = true;
		Debugger::enable($this->mode, $logDirectory, $email);
	}


	/**
	 * Add path or paths to list.
	 * @param  string  ...$paths  absolute path
	 */
	public function createRobotloader(...$paths): RobotLoader
	{
		$loader = new RobotLoader;
		$loader->addDirectory($paths);
		$loader->setTempDirectory($this->temp);
		$loader->register();
		return $loader;
	}


	/**
	 * Latte, template engine.
	 */
	public function addLatteEngine(): Latte
	{
		$latte = new Latte($this->temp);
		return $latte;
	}
}
