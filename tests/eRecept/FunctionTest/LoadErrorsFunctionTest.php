<?php declare (strict_types = 1);

namespace eRecept\FunctionTest;

use eRecept\EreceptVersion;
use eRecept\Request\Entity\Message;
use eRecept\Request\Entity\OnlyMessageEntity;
use eRecept\Request\LoadErrorsRequest;
use eRecept\Response\NacistCiselnikChybResponse;

class LoadErrorsFunctionTest extends FunctionTest
{

	public function testClient()
	{
		$messageEntity = new OnlyMessageEntity(
			new Message(
				EreceptVersion::get(EreceptVersion::V_201704A),
				new \DateTimeImmutable('now', new \DateTimeZone('Europe/Prague')),
				'0123456789AB'
			)
		);

		$response = $this->getClient()->send(new LoadErrorsRequest($messageEntity));

		$this->assertInstanceOf(NacistCiselnikChybResponse::class, $response);
		$this->assertTrue($response->isValid());
	}

}
