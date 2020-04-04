<?php

declare(strict_types = 1);

require __DIR__ . '/../../bootstrap.php';


class Responses
{
	use Drago\Simple\Base\Responses;
}

$class = new Responses;
$class->redirect('#');
Tester\Assert::same(302, (new Nette\Http\Response)->getCode());
