<?php declare (strict_types = 1);

namespace eRecept\FunctionTest;

use eRecept\EreceptVersion;
use eRecept\Method;
use eRecept\Request\CreatePrescriptionRequest;
use eRecept\Request\Entity\CreatePrescription;
use eRecept\Request\Entity\Document\Doctor;
use eRecept\Request\Entity\Document\Document;
use eRecept\Request\Entity\Document\DocumentState;
use eRecept\Request\Entity\Medicine\Medicine;
use eRecept\Request\Entity\Medicine\MedicineInfo;
use eRecept\Request\Entity\Medicine\MedicinePayment;
use eRecept\Request\Entity\Message;
use eRecept\Request\Entity\Patient\Address;
use eRecept\Request\Entity\Patient\Patient;
use eRecept\Request\Entity\Patient\Sex;
use eRecept\Response\ZalozitPredpisResponse;

class CreateRequestFunctionTest extends FunctionTest
{

	public function testClient()
	{
		$medicines = [];
		$medicines[] = new Medicine(
			1,
			'instrukce',
			MedicinePayment::get(MedicinePayment::PATIENT),
			1,
			new MedicineInfo(
				'AUGMENTIN 625 MG',
				'0086148',
				'J01CR02',
				'TBL FLM',
				'500MG/125MG',
				'POR',
				'21 II'
			)
		);

		$createPrescription = new CreatePrescription(
			new Message(
				EreceptVersion::get(EreceptVersion::V_201704A),
				new \DateTimeImmutable('now', new \DateTimeZone('Europe/Prague')),
				'0123456789AB'
			),
			new Document(
				new \DateTimeImmutable('now', new \DateTimeZone('Europe/Prague')),
				new \DateTimeImmutable('now', new \DateTimeZone('Europe/Prague')),
				true,
				true,
				false,
				new Patient(
					['Tomas'],
					'Pesek',
					new \DateTimeImmutable('1988-12-10 00:00:00', new \DateTimeZone('Europe/Prague')),
					new Address(
						'Pardubice',
						'53003',
						'Štrossova',
						'567'
					),
					'8812101111',
					'111',
					'774324030',
					'tomas@medoro.org',
					110,
					Sex::get(Sex::MALE),
					null,
					'OP',
					'111111111'
				),
				new Doctor(
					'12345678',
					'00000000007',
					'774324030',
					'305',
					'Test',
					'12340000',
					'tomas@medoro.org'
				),
				$medicines,
				'Comment',
				'PRISTI_NAVSTEVA',
				DocumentState::get(DocumentState::SENT)
			)
		);

		$response = $this->getClient(true)->send(Method::get(Method::METHOD_CREATE_PRESCRIPTION), new CreatePrescriptionRequest($createPrescription, $this->userPersonalData));

		$this->assertInstanceOf(ZalozitPredpisResponse::class, $response);
		$this->assertTrue($response->isValid());
	}

}
