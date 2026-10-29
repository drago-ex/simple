<?php declare(strict_types=1);

/**
 * Test: Drago\Simple\Base\Session
 */

use Nette\Http\Session;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';


class TestSession
{
	use Drago\Simple\Base\Session;
}


test('The same session object is returned on every call', function () {
	$class = new TestSession;
	Assert::type(Session::class, $class->session());
	Assert::same($class->session(), $class->session());
});
