<?php declare (strict_types = 1);

namespace eRecept\Request;

use eRecept\EreceptVersion;
use eRecept\Request\Entity\CancelPrescription;
use eRecept\Request\Entity\Message;
use eRecept\UserPersonalData;

class CancelPrescriptionRequestTest extends \PHPUnit\Framework\TestCase
{

	public function testRequest(): void
	{
		$userPersonalData = new UserPersonalData(
			'',
			'',
			'',
			'123',
			'pass'
		);

		$cancelPrescription = new CancelPrescription(
			new Message(
				EreceptVersion::get(EreceptVersion::V_201704A),
				new \DateTimeImmutable('2017-11-14 14:46:12', new \DateTimeZone('Europe/Prague')),
				'123'
			),
			$userPersonalData->getUserUid(),
			'workplace',
			'documentID',
			new \DateTimeImmutable('2017-11-21 14:15:00', new \DateTimeZone('Europe/Prague')),
			'cancel reason',
			'authorizationID'
		);

		$request = new CancelPrescriptionRequest($cancelPrescription);
		$requestData = $request->getData();

		$this->assertArrayHasKey('ZruseniPredpisuDotaz', $requestData);

		$this->assertArrayHasKey('Zprava', $requestData['ZruseniPredpisuDotaz']);
		$this->assertArrayHasKey('Doklad', $requestData['ZruseniPredpisuDotaz']);

		$this->assertArrayHasKey('ID_Zpravy', $requestData['ZruseniPredpisuDotaz']['Zprava']);
		$this->assertArrayHasKey('Verze', $requestData['ZruseniPredpisuDotaz']['Zprava']);
		$this->assertArrayHasKey('Odeslano', $requestData['ZruseniPredpisuDotaz']['Zprava']);
		$this->assertArrayHasKey('SW_Klienta', $requestData['ZruseniPredpisuDotaz']['Zprava']);

		unset($requestData['ZruseniPredpisuDotaz']['Zprava']['ID_Zpravy']);

		$this->assertSame(
			[
				'Verze' => '201704A',
				'Odeslano' => '2017-11-14T14:46:12+01:00',
				'SW_Klienta' => '123',
			],
			$requestData['ZruseniPredpisuDotaz']['Zprava']
		);

		$this->assertSame(
			[
				'Uzivatel' => '123',
				'Pracoviste' => 'workplace',
				'ID_Dokladu' => 'documentID',
				'DatumZruseni' => '2017-11-21',
				'DuvodZruseni' => 'cancel reason',
				'AutorizacniID' => 'authorizationID',
			],
			$requestData['ZruseniPredpisuDotaz']['Doklad']
		);
	}

}
