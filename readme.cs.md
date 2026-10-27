# Drago Simple

Snadná konfigurace pro jednostránkové weby.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://github.com/drago-ex/simple/blob/main/license)
[![PHP version](https://badge.fury.io/ph/drago-ex%2Fsimple.svg)](https://badge.fury.io/ph/drago-ex%2Fsimple)
[![Tests](https://github.com/drago-ex/simple/actions/workflows/tests.yml/badge.svg)](https://github.com/drago-ex/simple/actions/workflows/tests.yml)
[![Coding Style](https://github.com/drago-ex/simple/actions/workflows/coding-style.yml/badge.svg)](https://github.com/drago-ex/simple/actions/workflows/coding-style.yml)

## Požadavky

- PHP >= 8.3, < 9
- Nette Framework
- Composer

## Instalace

```
composer require drago-ex/simple
```

## Další informace

- [Latte: skvělý šablonovací systém pro PHP](https://github.com/nette/latte)
- [Nette HTTP](https://github.com/nette/http)

## Latte

`Drago\Simple\Latte` je Latte engine, který do každé šablony předá `$basePath`:

```php
use Drago\Simple\Latte;

$latte = new Latte;
$latte->setTempDirectory(__DIR__ . '/../temp/latte');
```

```latte
<link rel="stylesheet" href="{$basePath}/css/style.css">
```

## Traity

### Trait Session

```php
use Drago\Simple\Base\Session;

// The session is created from the current request on the first call and then reused
$this->session();
```

### Trait Message

```php
use Drago\Simple\Base\Message;

// Save a message for the next page
$this->flashMessage('Message...');

// Read the message; it is removed after reading, so it is shown only once
$this->getFlashMessage();
```

### Trait Response

```php
use Drago\Simple\Base\Response;

// Redirect to a URL; the script stops after the redirect is sent
$this->redirect('#');
```

## Příklad controlleru

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

## Formuláře

Nainstalujte Nette Forms přes Composer:
```
composer require nette/forms
```

Zaregistrujte značky formulářů v Latte:
```php
$latte->addExtension(new \Nette\Bridges\FormsLatte\FormsExtension);
```

## Překladač

`Drago\Simple\Translator` načte zprávy jednoho jazyka z PHP souboru, který vrací pole:

```php
// locale/cs.php
return [
	'Hello' => 'Ahoj',
	'Hello %s' => 'Ahoj %s',
];
```

Vyberte jazyk podle požadavku a zaregistrujte překladač v Latte:
```php
use Drago\Simple\Translator;
use Nette\Http\RequestFactory;

$lang = (new RequestFactory)->fromGlobals()->detectLanguage(['en', 'cs']) ?? 'en';
$translator = new Translator(__DIR__ . '/locale', $lang);

$latte->addExtension(new \Latte\Essential\TranslatorExtension($translator));
```

Překlady jsou pak v šablonách dostupné jako `{_'Hello'}`, `{_'Hello %s', $name}` nebo `{$text|translate}`;
zpráva bez překladu se zobrazí tak, jak je. Každý jazyk potřebuje svůj soubor (`locale/en.php` může vracet
`[]`), jinak překladač vyhodí výjimku. Funguje i jako překladač pro Nette Forms.

## Připravený balíček pro jednoduchý projekt

[https://github.com/drago-ex/simple-project](https://github.com/drago-ex/simple-project)
