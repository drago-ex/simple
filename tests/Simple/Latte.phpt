<?php

/**
 * Test: Drago\Simple\Latte
 */

declare(strict_types=1);

use Drago\Simple\Latte;
use Latte\Runtime\Template;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


$class = new Latte;
$latte = $class->createTemplate(__DIR__ . '/../latte/view.latte');

Assert::type(Template::class, $latte);
Assert::type('string', $latte->getParameters()['basePath']);
