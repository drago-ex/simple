<?php

/**
 * Test: Drago\Simple\Translator
 */

declare(strict_types=1);

use Drago\Simple\Latte;
use Drago\Simple\Translator;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

const LocaleDir = __DIR__ . '/../locale';


test('Messages are translated, unknown ones are returned unchanged', function () {
	$translator = new Translator(LocaleDir, 'cs');

	Assert::same('cs', $translator->getLanguage());
	Assert::same('Ahoj', $translator->translate('Hello'));
	Assert::same('Goodbye', $translator->translate('Goodbye'));
});


test('Parameters are inserted into the translation', function () {
	$translator = new Translator(LocaleDir, 'cs');
	Assert::same('Ahoj Jan, máš 3 zpráv', $translator->translate('Hello %s, you have %d messages', 'Jan', 3));
});


test('Latte translates with the translator', function () {
	$latte = new Latte;
	$latte->setLoader(new \Latte\Loaders\StringLoader);
	$latte->addExtension(new \Latte\Essential\TranslatorExtension(new Translator(LocaleDir, 'cs')));

	Assert::same('Ahoj Ahoj', $latte->renderToString('{_\'Hello\'} {=\'Hello\'|translate}'));
});


test('A missing or invalid language file is rejected', function () {
	Assert::exception(
		fn() => new Translator(LocaleDir, 'de'),
		InvalidArgumentException::class,
		"Translation file '%a%de.php' does not exist.",
	);
	Assert::exception(
		fn() => new Translator(LocaleDir, 'broken'),
		InvalidArgumentException::class,
		"Translation file '%a%broken.php' must return an array.",
	);
});


test('A language that could leave the directory is rejected', function () {
	Assert::exception(
		fn() => new Translator(LocaleDir, '../locale/cs'),
		InvalidArgumentException::class,
		"Invalid language '../locale/cs'.",
	);
});
