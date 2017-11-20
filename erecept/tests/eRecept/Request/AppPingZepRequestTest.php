<?php declare(strict_types = 1);

namespace eRecept\Request;

use eRecept\Request\Entity\AppPingZEP;
use eRecept\Request\Entity\Message;

class AppPingZepRequestTest extends \PHPUnit\Framework\TestCase
{

	public function testRequest()
	{
		$appPing = new AppPingZEP(
			new Message(
				'123',
				new \DateTimeImmutable('2017-10-05 14:46:12', new \DateTimeZone('Europe/Prague')),
				'123'
			)
		);

		$request = new AppPingZepRequest($appPing);
		$requestData = $request->getData();

		$this->assertArrayHasKey('AppPingZEPDotaz', $requestData);

		$this->assertArrayHasKey('Zprava', $requestData['AppPingZEPDotaz']);

		$this->assertArrayHasKey('ID_Zpravy', $requestData['AppPingZEPDotaz']['Zprava']);
		$this->assertArrayHasKey('Verze', $requestData['AppPingZEPDotaz']['Zprava']);
		$this->assertArrayHasKey('Odeslano', $requestData['AppPingZEPDotaz']['Zprava']);
		$this->assertArrayHasKey('SW_Klienta', $requestData['AppPingZEPDotaz']['Zprava']);

		unset($requestData['AppPingZEPDotaz']['Zprava']['ID_Zpravy']);

		$this->assertSame(
			[
				'Verze' => '123',
				'Odeslano' => '2017-10-05T14:46:12+02:00',
				'SW_Klienta' => '123',
			],
			$requestData['AppPingZEPDotaz']['Zprava']
		);
	}

}
