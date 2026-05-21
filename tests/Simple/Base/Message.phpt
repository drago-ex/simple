<?php

/**
 * Test: Drago\Simple\Base\Message
 */

declare(strict_types=1);

use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';


class TestMessage
{
	use Drago\Simple\Base\Message;
}

$class = new TestMessage;
$class->flashMessage('Message...');
Assert::type('string', $class->getFlashMessage());
Assert::same('Message...', $class->getFlashMessage());
