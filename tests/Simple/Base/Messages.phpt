<?php

declare(strict_types = 1);

namespace Test\Simple;

use Drago;
use Nette\Http\SessionSection;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';


class Messages
{
	use Drago\Simple\Base\Messages;
}

$class = new Messages;
Assert::type(SessionSection::class, $class->flashMessage('Message...'));
Assert::type('string', $class->getFlashMessage());
Assert::same('Message...', $class->getFlashMessage());
