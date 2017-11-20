<?php declare(strict_types = 1);

namespace eRecept\FunctionTest;

use eRecept\Method;
use eRecept\Request\AppPingZepRequest;
use eRecept\Request\Entity\AppPingZEP;
use eRecept\Request\Entity\Message;
use eRecept\Response\AppPingZEPResponse;

class AppPingZepClientFunctionTest extends FunctionTest
{

	public function testClient()
	{
		$appPingZep = new AppPingZEP(
			new Message(
				'201704A',
				new \DateTimeImmutable('now', new \DateTimeZone('Europe/Prague')),
				'0123456789AB'
			)
		);

		$response = $this->getClient(true)->send(Method::get(Method::METHOD_APP_PING_ZEP), new AppPingZepRequest($appPingZep));

		$this->assertInstanceOf(AppPingZEPResponse::class, $response);
		$this->assertTrue($response->isValid());
	}

}
