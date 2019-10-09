<?php

declare(strict_types = 1);

/**
 * Drago Extension
 * Package built on Nette Framework
 */

namespace Drago\Simple\Base;

use Nette\Http\SessionSection;


/**
 * Flash message.
 */
trait Messages
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
		$sessions = $this->fmId();
		$sessions->message = $message;
		$sessions->setExpiration('5 second');
		return $sessions;
	}


	/**
	 * Send message to template.
	 */
	public function getFlashMessage(): ?string
	{
		return $this->fmId()
			->message;
	}
}
