<?php

declare(strict_types=1);

namespace Drago\Simple\Base;


/** Flash message trait for managing session-based messages. */
trait Message
{
	use Session;

	private string $fm = 'fm';


	public function flashMessage(string $message): void
	{
		$section = $this->session()->getSection($this->fm);
		$section->set('message', $message);
		$section->setExpiration('5 seconds');
	}


	public function getFlashMessage(): ?string
	{
		$message = $this->session()->getSection($this->fm)->get('message');
		return is_string($message) && $message !== '' ? $message : null;
	}
}
