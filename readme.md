## Drago Simple
Easy configuration for single-page sites.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://raw.githubusercontent.com/drago-ex/simple/master/license.md)
[![PHP version](https://badge.fury.io/ph/drago-ex%2Fsimple.svg)](https://badge.fury.io/ph/drago-ex%2Fsimple)
[![Tests](https://github.com/drago-ex/simple/actions/workflows/tests.yml/badge.svg)](https://github.com/drago-ex/simple/actions/workflows/tests.yml)
[![Coding Style](https://github.com/drago-ex/simple/actions/workflows/coding-style.yml/badge.svg)](https://github.com/drago-ex/simple/actions/workflows/coding-style.yml)
[![CodeFactor](https://www.codefactor.io/repository/github/drago-ex/simple/badge)](https://www.codefactor.io/repository/github/drago-ex/simple)
[![Coverage Status](https://coveralls.io/repos/github/drago-ex/simple/badge.svg?branch=master)](https://coveralls.io/github/drago-ex/simple?branch=master)

## Technology
- PHP 8.1 or higher
- composer

## Knowledge
- [Latte: amazing template engine for PHP](https://github.com/nette/latte)
- [RobotLoader: comfortable autoloading](https://github.com/nette/robot-loader)
- [Nette HTTP Component](https://github.com/nette/http)
- [Tracy - PHP debugger](https://github.com/nette/tracy)

## Installation
```
composer require drago/simple
```

## Trait Session
```php
use Drago\Simple\Base\Session

// Get session.
$this->session();
```

## Trait Message
```php
use Drago\Simple\Base\Message;

// Save message.
$this->flashMessage('Message...');

// Print message.
$this->getFlashMessage();
```

## Trait Response
```php
use Drago\Simple\Base\Response;

$this->redirect('#');
```

## Controller
```php
final class Home
{
	private Latte\Engine $latte;


	public function __construct(Latte\Engine $latte)
	{
		$this->latte = $latte;
	}
}
```

## Template render
```php
public function render(): void
{
	$this->latte->render(__DIR__ . '/path/to/dir/template.latte');
}
```

## Template passing parameters
```php
public function render(): void
{
	$this-flashMessage('message...');
	$message['message'] = $this->getFlashMessage();
	$this->latte->render(__DIR__ . '/path/to/dir/template.latte', $message);
}
```

## Template print message
```latte
<p n:if="$message">{$message}</p>
```

## Template default parameter for include files
```latte
{$basePath}
```

## Forms
Install via composer.
```
composer require nette/forms
```

Forms latte macro.
```php
$latte->onCompile[] = function () use ($latte) {
	FormMacros::install($latte->getCompiler());
};
```

## Translator
Install via composer.
```
composer require drago-ex/translator
```

Translator property.
```php
private array $lang = ['en', 'cs'];
```

Translator language detect.
```php
$translator = new Translator(__DIR__ . '/locale');
$translator->setTranslate((new RequestFactory())->fromGlobals()
	->detectLanguage($this->lang)
);
```

Translator latte filter.
```php
$latte->addFilter('translate', function ($message) use ($translator) {
	return $translator->translate($message);
});
```

## Prepared package for simple project
[https://github.com/drago-ex/simple-project](https://github.com/drago-ex/simple-project)
