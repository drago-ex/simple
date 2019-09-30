<?php

declare(strict_types = 1);

/**
 * Drago Single
 * Package built on Nette Framework
 */
namespace Single;

use Nette\Http\Response;


/**
 * Single web pages.
 * @package Drago\Single
 */
trait Single
{
	/** @var string */
	private $fm = 'flash';

	public function getSessions(): Sessions
	{
		return new Sessions;
	}


	/**
	 * Http requests.
	 */
	public function getResponse(): Response
	{
		return new Response;
	}


	/**
	 * Http redirect.
	 */
	public function redirect(string $url): void
	{
		$redirect = $this->getResponse();
		$redirect->redirect($url);
	}


	/**
	 * Saves the message to sessions.
	 */
	public function flashMessage(string $message): string
	{
		$sessions = $this->getSessions()
			->getSessionSection($this->fm);

		$sessions->message = $message;
		$sessions->setExpiration('5 second');
		return $sessions->message;
	}


	/**
	 * Send message to template.
	 */
	public function getFlashMessage(): string
	{
		$sessions = $this->getSessions()
			->getSessionSection($this->fm);

		return $sessions->message;
	}
}
