<?php

/**
 * Drago Extension
 * Package built on Nette Framework
 */

declare(strict_types=1);

namespace Drago\Simple\Base;

use Nette\Http\SessionSection;


/**
 * Flash message trait for managing session-based messages.
 */
trait Message
{
	use Session;

	private string $fm = 'fm';


	/**
	 * Retrieves the flash message session section.
	 */
	private function fmId(): SessionSection|Section
	{
		return $this->session()
			->getSection($this->fm);
	}


	/**
	 * Saves the flash message to the session.
	 */
	public function flashMessage(string $message): SessionSection
	{
		$session = $this->fmId();
		$session->message = $message;
		$session->setExpiration('5 seconds');
		return $session;
	}


	/**
	 * Retrieves the flash message for the template.
	 */
	public function getFlashMessage(): ?string
	{
		return $this->fmId()
			->message;
	}
}
