<?php

declare(strict_types = 1);

use Nette\Http\SessionSection;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';

class TestMessage
{
	use Drago\Simple\Base\Message;
}

$class = new TestMessage;
Assert::type(SessionSection::class, $class->flashMessage('Message...'));
Assert::type('string', $class->getFlashMessage());
Assert::same('Message...', $class->getFlashMessage());
