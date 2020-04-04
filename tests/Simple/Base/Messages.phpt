<?php

declare(strict_types = 1);

use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';


class Messages
{
	use Drago\Simple\Base\Messages;
}

$class = new Messages;
Assert::type(Nette\Http\SessionSection::class, $class->flashMessage('Message...'));
Assert::type('string', $class->getFlashMessage());
Assert::same('Message...', $class->getFlashMessage());
