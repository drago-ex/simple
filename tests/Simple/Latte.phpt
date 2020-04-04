<?php

declare(strict_types = 1);

use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

$class = new Drago\Simple\Latte;
$latte = $class->createTemplate(__DIR__ . '/../latte/view.latte');

Assert::type(Latte\Runtime\Template::class, $latte);
Assert::type('string', $latte->getParameters()['basePath']);
