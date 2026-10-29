<?php declare(strict_types=1);

/**
 * Test: Drago\Simple\Translator
 */

use Drago\Simple\Latte;
use Drago\Simple\Translator;
use Latte\Essential\TranslatorExtension;
use Latte\Loaders\StringLoader;
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
	$latte->setLoader(new StringLoader);
	$latte->addExtension(new TranslatorExtension(new Translator(LocaleDir, 'cs')));

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


test('A null parameter or a message with other placeholders does not break the translation', function () {
	$translator = new Translator(LocaleDir, 'cs');

	// Nette Forms passes null when the rule has no number and formats %d / %label itself
	Assert::same('Please enter a value between %d and %d.', $translator->translate('Please enter a value between %d and %d.', null));
	Assert::same('%label is required', $translator->translate('%label is required', null));
	Assert::same('%label is required', $translator->translate('%label is required', 5));
	Assert::same('Discount 50%', $translator->translate('Discount 50%', 'x'));
});
