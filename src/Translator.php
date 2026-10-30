<?php declare(strict_types=1);

namespace Drago\Simple;

use InvalidArgumentException;
use Nette\Localization;
use function is_array;


/**
 * Translator for single-page sites: messages of one language from a PHP file
 * returning an array, e.g. `locale/cs.php` with `return ['Hello' => 'Ahoj'];`.
 */
final class Translator implements Localization\Translator
{
	/** @var array<string, string> */
	private array $messages;


	/** @throws InvalidArgumentException When the language file does not exist or does not return an array. */
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

		// only texts are translations; an array (e.g. plural forms) or an object is left out
		$this->messages = array_map(strval(...), array_filter($messages, is_scalar(...)));
	}


	public function getLanguage(): string
	{
		return $this->language;
	}


	/**
	 * Returns the translation, or the message itself when it has none; parameters are inserted by sprintf().
	 * Nette Forms always passes one more parameter (null when the rule has no number) and inserts %d, %label
	 * etc. itself, so null parameters are ignored and a message whose placeholders do not fit is returned as it is.
	 */
	public function translate(string|\Stringable $message, mixed ...$parameters): string
	{
		$message = (string) $message;
		$translation = $this->messages[$message] ?? $message;
		$parameters = array_values(array_filter($parameters, fn(mixed $parameter): bool => $parameter !== null));
		if ($parameters === []) {
			return $translation;
		}

		try {
			return vsprintf($translation, $parameters);
		} catch (\ValueError) {
			return $translation;
		}
	}
}
