## Drago Simple
Easy configuration for single-page sites.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://raw.githubusercontent.com/drago-ex/simple/master/license.md)
[![PHP version](https://badge.fury.io/ph/drago-ex%2Fsimple.svg)](https://badge.fury.io/ph/drago-ex%2Fsimple)
[![Tests](https://github.com/drago-ex/simple/actions/workflows/tests.yml/badge.svg)](https://github.com/drago-ex/simple/actions/workflows/tests.yml)
[![Coding Style](https://github.com/drago-ex/simple/actions/workflows/coding-style.yml/badge.svg)](https://github.com/drago-ex/simple/actions/workflows/coding-style.yml)
[![CodeFactor](https://www.codefactor.io/repository/github/drago-ex/simple/badge)](https://www.codefactor.io/repository/github/drago-ex/simple)
[![Coverage Status](https://coveralls.io/repos/github/drago-ex/simple/badge.svg?branch=master)](https://coveralls.io/github/drago-ex/simple?branch=master)

## Technology
- PHP 8.3 or higher
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

# Traits
## Session Trait
```php
use Drago\Simple\Base\Session;

// Get session instance
$this->session();
```

## Message Trait
```php
use Drago\Simple\Base\Message;

// Save message to session
$this->flashMessage('Message...');

// Retrieve flash message from session
$this->getFlashMessage();
```

## Response Trait
```php
use Drago\Simple\Base\Response;

// Redirect to a URL
$this->redirect('#');
```

## Controller Example
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

## Template Rendering
```php
public function render(): void
{
    $this->latte->render(__DIR__ . '/path/to/dir/template.latte');
}
```

## Passing Parameters to Templates
```php
public function render(): void
{
    $this->flashMessage('message...');
    $message['message'] = $this->getFlashMessage();
    $this->latte->render(__DIR__ . '/path/to/dir/template.latte', $message);
}
```

## Template: Print Message
```latte
<p n:if="$message">{$message}</p>
```

## Template: Default Parameter for Include Files
```latte
{$basePath}
```

## Forms
Install Nette Forms via Composer:
```
composer require nette/forms
```

## Forms Latte Macro
```php
$latte->onCompile[] = function () use ($latte) {
	FormMacros::install($latte->getCompiler());
};
```

## Translator
Install the Translator via Composer:
```
composer require drago-ex/translator
```

## Translator Property
```php
private array $lang = ['en', 'cs'];
```

## Translator Language Detection
```php
$translator = new Translator(__DIR__ . '/locale');
$translator->setTranslate((new RequestFactory())->fromGlobals()
	->detectLanguage($this->lang)
);
```

## Translator Latte Filter
```php
$latte->addFilter('translate', function ($message) use ($translator) {
	return $translator->translate($message);
});
```

## Prepared Package for Simple Project
[https://github.com/drago-ex/simple-project](https://github.com/drago-ex/simple-project)
