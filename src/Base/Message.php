<?php declare(strict_types=1);

namespace Drago\Simple\Base;

use function is_string;


/** Flash message trait for managing session-based messages. */
trait Message
{
	use Session;

	private string $fm = 'fm';


	/** Stores a message for the next page; it is kept for up to 5 minutes until it is read. */
	public function flashMessage(string $message): void
	{
		$section = $this->session()->getSection($this->fm);
		$section->set('message', $message);
		$section->setExpiration('5 minutes');
	}


	/** Returns the message once and removes it, so it is not shown again after a refresh. */
	public function getFlashMessage(): ?string
	{
		$section = $this->session()->getSection($this->fm);
		$message = $section->get('message');
		$section->remove('message');
		return is_string($message) && $message !== '' ? $message : null;
	}
}
