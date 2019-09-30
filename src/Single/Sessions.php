<?php

declare(strict_types = 1);

/**
 * Drago Single
 * Package built on Nette Framework
 */
namespace Single;

use Nette\Http\RequestFactory;
use Nette\Http\Response;
use Nette\Http\Session;
use Nette\Http\SessionSection;
use Nette\SmartObject;


/**
 * Single web pages.
 * @package Drago\Single
 */
class Sessions
{
	use SmartObject;

	public function session(): Session
	{
		$request = (new RequestFactory)->createHttpRequest();
		return new Session($request, new Response);
	}


	public function getSessionSection(string $section): SessionSection
	{
		return $this->session()->getSection($section);
	}
}
