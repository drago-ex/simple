<?php

declare(strict_types = 1);

/**
 * Drago Extension
 * Package built on Nette Framework
 */
namespace Drago\Simple\Base;

use Nette\Forms\Form;


/**
 * Creates, validates and renders HTML forms.
 * @package Drago\Simple
 */
trait Forms
{
	public function forms()
	{
		return new Form;
	}
}
