<?php declare(strict_types = 1);

namespace eRecept\FunctionTest;

use eRecept\EreceptVersion;
use eRecept\Method;
use eRecept\Request\AppPingRequest;
use eRecept\Request\Entity\AppPing;
use eRecept\Request\Entity\Message;
use eRecept\Response\AppPingResponse;

class AppPingClientFunctionTest extends FunctionTest
{

	public function testClient()
	{
		$appPing = new AppPing(
			new Message(
				EreceptVersion::get(EreceptVersion::V_201704A),
				new \DateTimeImmutable('now', new \DateTimeZone('Europe/Prague')),
				'0123456789AB'
			)
		);

		$response = $this->getClient()->send(Method::get(Method::METHOD_APP_PING), new AppPingRequest($appPing));

		$this->assertInstanceOf(AppPingResponse::class, $response);
		$this->assertTrue($response->isValid());
	}

}
