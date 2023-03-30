<?php

/**
 * Drago Extension
 * Package built on Nette Framework
 */

declare(strict_types=1);

namespace Drago\Simple\Base;

use Nette\Http\SessionSection;


/**
 * Flash message.
 */
trait Message
{
	use Session;

	private string $fm = 'fm';


	private function fmId(): SessionSection|Section
	{
		return $this->session()
			->getSection($this->fm);
	}


	/**
	 * Save the message.
	 */
	public function flashMessage(string $message): SessionSection
	{
		$session = $this->fmId();
		$session->message = $message;
		$session->setExpiration('5 second');
		return $session;
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
