# Agent Guide

Use this file as package-specific guidance when working in this repository. Keep changes aligned with the existing public API, project conventions, and supported PHP range.

## Package Overview
- **Package**: `drago-ex/simple`
- **Type**: library
- **Purpose**: Easy configuration for single-page sites.
- **PHP**: >=8.3 <9
- **Runtime dependencies**: latte/latte (^3.0), nette/http (^3.3), nette/utils (^4.0)
- **License**: MIT

## Repository Layout
- `src/`: package source code.
- `tests/`: automated tests.
- `.github/`: CI workflows; keep their PHP versions and commands consistent with Composer and the package scripts.
- `composer.json`: package metadata, dependency constraints, autoloading, and available Composer scripts.

## Key Parts
- Traits for single-page sites without the Nette application: `Base\Session` (one session per object), `Base\Message` (flash message read once), `Base\Response` (redirect, then `terminate()` exits; tests override it).
- `Drago\Simple\Latte` adds `$basePath` to every template. Only Latte 3 APIs apply (`FormsExtension`, `TranslatorExtension`).
- `Drago\Simple\Translator` (Nette `Localization\Translator`) loads `<dir>/<language>.php` returning an array; unknown messages are returned unchanged, parameters go through `vsprintf()`. The language is validated (`[\w-]+`) because it often comes from the request. It replaced the README example with drago-ex/translator, which is too big for single-page sites since 4.x.
- README examples write `\Latte\...` and `\Nette\...` with a leading backslash: next to `use Drago\Simple\Latte;` a relative `Latte\...` resolves to `Drago\Simple\Latte\...`.

## Dependencies

Composer constraints describe the package contract. Before changing integration behavior, inspect the source and the actual call sites in this package; do not infer runtime usage solely from dependency declarations.
Development dependencies include nette/tester (^2.5), phpstan/phpstan (^2.0), phpstan/phpstan-nette (^2.0).

## Essential Commands

```bash
composer tester                 # tester tests -s -C
composer phpstan                # phpstan analyse
```

## Conventions & Rules

- Preserve backward compatibility unless the task explicitly permits a breaking change. Check callers and public signatures before changing behavior.
- Follow the existing PHP style: strict types, explicit parameter and return types, tabs for indentation, and single-quoted strings where practical. Match nearby code when a convention is unclear.
- Keep package-specific configuration, resources, and migrations in their established directories. Do not edit generated or consuming-project files without confirming they are part of this repository’s intended output.
- Add or update focused tests for behavioral changes when this package has a runnable test setup. Do not invent test commands; use only the scripts and configuration present here.
- Update README examples and Composer metadata when a public API or supported requirement changes.
