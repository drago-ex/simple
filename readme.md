# Drago Simple

Easy configuration for single-page sites.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://github.com/drago-ex/simple/blob/main/license)
[![PHP version](https://badge.fury.io/ph/drago-ex%2Fsimple.svg)](https://badge.fury.io/ph/drago-ex%2Fsimple)
[![Tests](https://github.com/drago-ex/simple/actions/workflows/tests.yml/badge.svg)](https://github.com/drago-ex/simple/actions/workflows/tests.yml)
[![Coding Style](https://github.com/drago-ex/simple/actions/workflows/coding-style.yml/badge.svg)](https://github.com/drago-ex/simple/actions/workflows/coding-style.yml)

## Requirements

- PHP >= 8.3, < 9
- Nette Framework
- Composer

## Installation

```
composer require drago-ex/simple
```

## Knowledge

- [Latte: amazing template engine for PHP](https://github.com/nette/latte)
- [RobotLoader: comfortable autoloading](https://github.com/nette/robot-loader)
- [Nette HTTP Component](https://github.com/nette/http)
- [Tracy - PHP debugger](https://github.com/nette/tracy)

## Latte

`Drago\Simple\Latte` is a Latte engine that passes `$basePath` to every template:

```php
use Drago\Simple\Latte;

$latte = new Latte;
$latte->setTempDirectory(__DIR__ . '/../temp/latte');
```

```latte
<link rel="stylesheet" href="{$basePath}/css/style.css">
```

## Traits

### Session Trait

```php
use Drago\Simple\Base\Session;

// The session is created from the current request on the first call and then reused
$this->session();
```

### Message Trait

```php
use Drago\Simple\Base\Message;

// Save a message for the next page
$this->flashMessage('Message...');

// Read the message; it is removed after reading, so it is shown only once
$this->getFlashMessage();
```

### Response Trait

```php
use Drago\Simple\Base\Response;

// Redirect to a URL; the script stops after the redirect is sent
$this->redirect('#');
```

## Controller Example

```php
use Drago\Simple\Base\Message;
use Drago\Simple\Latte;

final class Home
{
	use Message;

	public function __construct(
		private Latte $latte,
	) {
	}


	public function render(): void
	{
		$this->latte->render(__DIR__ . '/templates/Home.latte', [
			'message' => $this->getFlashMessage(),
		]);
	}
}
```

```latte
<p n:if="$message">{$message}</p>
```

## Forms

Install Nette Forms via Composer:
```
composer require nette/forms
```

Register the form tags in Latte:
```php
$latte->addExtension(new Nette\Bridges\FormsLatte\FormsExtension);
```

## Translator

Install the Translator via Composer:
```
composer require drago-ex/translator
```

Create the translator with your translation directory and choose the language from the request:
```php
use Drago\Localization\Options;
use Drago\Localization\Translator;
use Drago\Localization\TranslatorFinder;
use Nette\Http\RequestFactory;

$options = new Options;
$options->translateDirs = [__DIR__ . '/locale'];

$translator = new Translator($options, new TranslatorFinder);
$lang = (new RequestFactory)->fromGlobals()->detectLanguage(['en', 'cs']) ?? 'en';
$translator->setTranslate($lang);

$latte->addExtension(new Latte\Essential\TranslatorExtension($translator->translate(...)));
```

Translations are then available in templates as `{_'Hello'}` or `{$text|translate}`.

## Prepared Package for Simple Project

[https://github.com/drago-ex/simple-project](https://github.com/drago-ex/simple-project)
