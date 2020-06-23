<p align="center">
  <img src="https://avatars0.githubusercontent.com/u/11717487?s=400&u=40ecb522587ebbcfe67801ccb6f11497b259f84b&v=4" width="100" alt="logo">
</p>

<h3 align="center">Drago Extension</h3>
<p align="center">Extension for Nette Framework</p>

## Drago Simple
Easy configuration for single-page sites.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://raw.githubusercontent.com/drago-ex/simple/master/license.md)
[![PHP version](https://badge.fury.io/ph/drago-ex%2Fsimple.svg)](https://badge.fury.io/ph/drago-ex%2Fsimple)
[![Build Status](https://travis-ci.org/drago-ex/simple.svg?branch=master)](https://travis-ci.org/drago-ex/simple)
[![CodeFactor](https://www.codefactor.io/repository/github/drago-ex/simple/badge)](https://www.codefactor.io/repository/github/drago-ex/simple)
[![Coverage Status](https://coveralls.io/repos/github/drago-ex/simple/badge.svg?branch=master)](https://coveralls.io/github/drago-ex/simple?branch=master)

## Requirements
- PHP 7.4 or higher
- composer

## Installation
```
composer require drago/simple
```

## Session
```php
use Drago\Simple\Base\Session

// Get session.
$this->session();
```

## Message
```php
use Drago\Simple\Base\Message;

// Save message.
$this->flashMessage('Message...');

// Print message.
$this->getFlashMessage();
```

## Print message in template
```latte
<p n:if="$message">{$message}</p>
```

## Response
```php
use Drago\Simple\Base\Response;

$this->redirect('#');
```

## Controller
```php
final class HomeController
{
	private Latte\Engine $latte;


	public function __construct(Latte\Engine $latte)
	{
		$this->latte = $latte;
	}
}
```

## View
```php
public function render(): void
{
	$this->latte->render(__DIR__ . '/path/to/dir/view.latte');
}
```

## View parameter for include files
```latte
{$basePath}
```

## Forms
Install via composer.
```
composer require nette/forms
```

Add form macro.
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

Translate property.
```php
private array $lang = ['en', 'cs'];
```

Translate detect.
```php
$locale = (new Request)->detectLanguage($this->lang);
$translator = new Translator(__DIR__ . '/path/to/dir/' . $locale . '.ini');
```

Add translate filter.
```php
$this->latte->addFilter('translate', function ($message) use ($translator) {
	return $translator->translate($message);
});
```

## Prepared package for generator
[https://github.com/drago-ex/simple-project](https://github.com/drago-ex/simple-project)
