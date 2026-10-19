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


test('A flash message is returned once and then removed', function () {
	$class = new TestMessage;
	$class->flashMessage('Message...');

	Assert::same('Message...', $class->getFlashMessage());
	Assert::null($class->getFlashMessage());
});


test('Without a message null is returned', function () {
	Assert::null((new TestMessage)->getFlashMessage());
});
