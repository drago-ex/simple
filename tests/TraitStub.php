<?php declare(strict_types=1);

use Drago\Simple\Base\Message;
use Drago\Simple\Base\Response;


/** Lets PHPStan analyse the Message and Response traits (Message brings in Session), which no class in the package uses. */
class TraitStub
{
	use Message;
	use Response;
}
