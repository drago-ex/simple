<?php

declare(strict_types=1);

namespace Drago\Simple;

use InvalidArgumentException;
use Nette\Localization;


/**
 * Translator for single-page sites: messages of one language from a PHP file
 * returning an array, e.g. `locale/cs.php` with `return ['Hello' => 'Ahoj'];`.
 */
final class Translator implements Localization\Translator
{
	/** @var array<string, string> */
	private array $messages;


	/**
	 * @throws InvalidArgumentException When the language file does not exist or does not return an array.
	 */
	public function __construct(
		string $dir,
		private readonly string $language,
	) {
		// The language often comes from the request, so it must not lead outside the directory.
		if (!preg_match('#^[\w-]+$#D', $language)) {
			throw new InvalidArgumentException("Invalid language '$language'.");
		}

		$file = "$dir/$language.php";
		if (!is_file($file)) {
			throw new InvalidArgumentException("Translation file '$file' does not exist.");
		}

		$messages = require $file;
		if (!is_array($messages)) {
			throw new InvalidArgumentException("Translation file '$file' must return an array.");
		}

		$this->messages = array_map(strval(...), $messages);
	}


	public function getLanguage(): string
	{
		return $this->language;
	}


	/** Returns the translation, or the message itself when it has none; parameters are inserted by sprintf(). */
	public function translate(string|\Stringable $message, mixed ...$parameters): string
	{
		$message = (string) $message;
		$translation = $this->messages[$message] ?? $message;
		return $parameters === [] ? $translation : vsprintf($translation, $parameters);
	}
}
