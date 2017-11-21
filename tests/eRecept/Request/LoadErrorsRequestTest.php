<?php declare (strict_types = 1);

namespace eRecept\Request;

use eRecept\EreceptVersion;
use eRecept\Request\Entity\Message;
use eRecept\Request\Entity\OnlyMessageEntity;

class LoadErrorsRequestTest extends \PHPUnit\Framework\TestCase
{

	public function testRequestFormatting()
	{
		$messageEntity = new OnlyMessageEntity(
			$message = new Message(
				EreceptVersion::get(EreceptVersion::V_201704A),
				new \DateTimeImmutable('2017-10-05 14:46:12', new \DateTimeZone('Europe/Prague')),
				'123'
			)
		);

		$request = new LoadErrorsRequest($messageEntity);
		$requestData = $request->getData();

		$this->assertArrayHasKey('CisChybDotaz', $requestData);

		$this->assertArrayHasKey('Zprava', $requestData['CisChybDotaz']);

		$this->assertArrayHasKey('ID_Zpravy', $requestData['CisChybDotaz']['Zprava']);
		$this->assertArrayHasKey('Verze', $requestData['CisChybDotaz']['Zprava']);
		$this->assertArrayHasKey('Odeslano', $requestData['CisChybDotaz']['Zprava']);
		$this->assertArrayHasKey('SW_Klienta', $requestData['CisChybDotaz']['Zprava']);

		unset($requestData['CisChybDotaz']['Zprava']['ID_Zpravy']);

		$this->assertSame(
			[
				'Verze' => '201704A',
				'Odeslano' => '2017-10-05T14:46:12+02:00',
				'SW_Klienta' => '123',
			],
			$requestData['CisChybDotaz']['Zprava']
		);
	}

}
