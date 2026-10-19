<?php

/**
 * Test: Drago\Simple\Base\Response
 */

declare(strict_types=1);

use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';


class TestResponse
{
	use Drago\Simple\Base\Response;

	public bool $terminated = false;


	protected function terminate(): void
	{
		$this->terminated = true;
	}
}


test('Redirect sends the status code and stops the script', function () {
	$class = new TestResponse;
	$class->redirect('/target', 303);

	Assert::same(303, http_response_code());
	Assert::true($class->terminated);
});
