<?php declare (strict_types = 1);

namespace eRecept\Request;

use eRecept\EreceptVersion;
use eRecept\Request\Entity\Message;
use eRecept\Request\Entity\OnlyMessageEntity;

class LoadVersionsRequestTest extends \PHPUnit\Framework\TestCase
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

		$request = new LoadVersionsRequest($messageEntity);
		$requestData = $request->getData();

		$this->assertArrayHasKey('VerzeDotaz', $requestData);

		$this->assertArrayHasKey('Zprava', $requestData['VerzeDotaz']);

		$this->assertArrayHasKey('ID_Zpravy', $requestData['VerzeDotaz']['Zprava']);
		$this->assertArrayHasKey('Verze', $requestData['VerzeDotaz']['Zprava']);
		$this->assertArrayHasKey('Odeslano', $requestData['VerzeDotaz']['Zprava']);
		$this->assertArrayHasKey('SW_Klienta', $requestData['VerzeDotaz']['Zprava']);

		unset($requestData['VerzeDotaz']['Zprava']['ID_Zpravy']);

		$this->assertSame(
			[
				'Verze' => '201704A',
				'Odeslano' => '2017-10-05T14:46:12+02:00',
				'SW_Klienta' => '123',
			],
			$requestData['VerzeDotaz']['Zprava']
		);
	}

}
