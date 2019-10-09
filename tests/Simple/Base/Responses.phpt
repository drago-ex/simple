<?php

declare(strict_types = 1);

namespace Test\Simple;

use Drago;
use Nette\Http\Response;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';


class Responses
{
	use Drago\Simple\Base\Responses;
}

$class = new Responses;
$class->redirect('#');
Assert::same(302, (new Response)->getCode());
