<?php

declare(strict_types = 1);

namespace Test\Simple;

use Drago;
use Nette\Http\Session;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';


class Sessions
{
	use Drago\Simple\Base\Sessions;
}

$class = new Sessions;
Assert::type(Session::class, $class->session());
