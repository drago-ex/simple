<?php

declare(strict_types = 1);

/**
 * Drago Extension
 * Package built on Nette Framework
 */
namespace Drago\Simple;

use Drago\Simple\Base\Sessions;
use Nette\Http\SessionSection;


/**
 * Flash message.
 */
class Messages
{
	use Sessions;

	/** @var string */
	private $fm = 'fm';


	private function fmId(): SessionSection
	{
		return $this->session()
			->getSection($this->fm);
	}


	/**
	 * Save the message.
	 */
	public function flashMessage(string $message): SessionSection
	{
		$message = $this->fmId();
		$message->message = $message;
		$message->setExpiration('5 second');
		return $message;
	}


	/**
	 * Send message to template.
	 */
	public function getFlashMessage(): string
	{
		return $this->fmId()
			->message;
	}
}
