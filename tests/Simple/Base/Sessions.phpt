<?php

declare(strict_types = 1);

require __DIR__ . '/../../bootstrap.php';


class Sessions
{
	use Drago\Simple\Base\Sessions;
}

$class = new Sessions;
Tester\Assert::type(Nette\Http\Session::class, $class->session());
