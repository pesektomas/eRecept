<?php declare(strict_types = 1);

namespace eRecept\Request;

use eRecept\EreceptVersion;
use eRecept\Request\Entity\AppPing;
use eRecept\Request\Entity\Message;

class AppPingRequestTest extends \PHPUnit\Framework\TestCase
{

	public function testRequestFormatting()
	{
		$appPing = new AppPing(
			new Message(
				EreceptVersion::get(EreceptVersion::V_201704A),
				new \DateTimeImmutable('2017-10-05 14:46:12', new \DateTimeZone('Europe/Prague')),
				'123'
			)
		);

		$request = new AppPingRequest($appPing);
		$requestData = $request->getData();

		$this->assertArrayHasKey('AppPingDotaz', $requestData);

		$this->assertArrayHasKey('Zprava', $requestData['AppPingDotaz']);

		$this->assertArrayHasKey('ID_Zpravy', $requestData['AppPingDotaz']['Zprava']);
		$this->assertArrayHasKey('Verze', $requestData['AppPingDotaz']['Zprava']);
		$this->assertArrayHasKey('Odeslano', $requestData['AppPingDotaz']['Zprava']);
		$this->assertArrayHasKey('SW_Klienta', $requestData['AppPingDotaz']['Zprava']);

		unset($requestData['AppPingDotaz']['Zprava']['ID_Zpravy']);

		$this->assertSame(
			[
				'Verze' => '201704A',
				'Odeslano' => '2017-10-05T14:46:12+02:00',
				'SW_Klienta' => '123',
			],
			$requestData['AppPingDotaz']['Zprava']
		);
	}

}
