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
trait Message
{
	use Session;

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
		return $this->fmId()->message;
	}
}
