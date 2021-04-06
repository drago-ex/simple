<?php

declare(strict_types=1);

use Nette\Http\Session;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';

class TestSession
{
	use Drago\Simple\Base\Session;
}

$class = new TestSession;
Assert::type(Session::class, $class->session());
