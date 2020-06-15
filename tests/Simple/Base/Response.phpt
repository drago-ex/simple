<?php

declare(strict_types = 1);

use Nette\Http\Response;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';

class TestResponse
{
	use Drago\Simple\Base\Response;
}

$class = new TestResponse;
$class->redirect('#');
Assert::same(302, (new Response)->getCode());
