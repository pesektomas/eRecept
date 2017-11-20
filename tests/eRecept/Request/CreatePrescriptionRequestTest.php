<?php declare (strict_types = 1);

namespace eRecept\Request;

use eRecept\Request\Entity\CreatePrescription;
use eRecept\Request\Entity\Document\Doctor;
use eRecept\Request\Entity\Document\Document;
use eRecept\Request\Entity\Document\DocumentState;
use eRecept\Request\Entity\Message;
use eRecept\Request\Entity\Patient\Address;
use eRecept\Request\Entity\Patient\Patient;
use eRecept\Request\Entity\Patient\Sex;
use eRecept\UserPersonalData;

class CreatePrescriptionRequestTest extends \PHPUnit\Framework\TestCase
{

	public function testRequest(): void
	{
		$userPersonalData = new UserPersonalData(
			'',
			'',
			'',
			'123',
			'123'
		);

		$medicines = [];

		$createPrescription = new CreatePrescription(
			new Message(
				'123',
				new \DateTimeImmutable('2017-11-14 14:46:12', new \DateTimeZone('Europe/Prague')),
				'123'
			),
			new Document(
				new \DateTimeImmutable('2017-12-05 14:46:12', new \DateTimeZone('Europe/Prague')),
				new \DateTimeImmutable('2017-12-15 14:46:12', new \DateTimeZone('Europe/Prague')),
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
					'1111111111',
					''
				),
				new Doctor(
					'1000001',
					'',
					'774324030',
					'101',
					'',
					'1000000',
					'tomas@medoro.org'
				),
				$medicines,
				'Comment',
				'Doctor alert',
				DocumentState::get(DocumentState::SENT)
			)
		);

		$request = new CreatePrescriptionRequest($createPrescription, $userPersonalData);
		$requestData = $request->getData();

		$this->assertArrayHasKey('ZalozeniPredpisuDotaz', $requestData);

		$this->assertArrayHasKey('Zprava', $requestData['ZalozeniPredpisuDotaz']);
		$this->assertArrayHasKey('Doklad', $requestData['ZalozeniPredpisuDotaz']);

		$this->assertArrayHasKey('ID_Zpravy', $requestData['ZalozeniPredpisuDotaz']['Zprava']);
		$this->assertArrayHasKey('Verze', $requestData['ZalozeniPredpisuDotaz']['Zprava']);
		$this->assertArrayHasKey('Odeslano', $requestData['ZalozeniPredpisuDotaz']['Zprava']);
		$this->assertArrayHasKey('SW_Klienta', $requestData['ZalozeniPredpisuDotaz']['Zprava']);

		unset($requestData['ZalozeniPredpisuDotaz']['Zprava']['ID_Zpravy']);

		$this->assertSame(
			[
				'Verze' => '123',
				'Odeslano' => '2017-11-14T14:46:12+01:00',
				'SW_Klienta' => '123',
			],
			$requestData['ZalozeniPredpisuDotaz']['Zprava']
		);

		$this->assertArrayHasKey('DatumVystaveni', $requestData['ZalozeniPredpisuDotaz']['Doklad']);
		$this->assertArrayHasKey('PlatnostDo', $requestData['ZalozeniPredpisuDotaz']['Doklad']);
		$this->assertArrayHasKey('Akutni', $requestData['ZalozeniPredpisuDotaz']['Doklad']);
		$this->assertArrayHasKey('Rodina', $requestData['ZalozeniPredpisuDotaz']['Doklad']);
		$this->assertArrayHasKey('Preshranicni', $requestData['ZalozeniPredpisuDotaz']['Doklad']);
		$this->assertArrayHasKey('Pacient', $requestData['ZalozeniPredpisuDotaz']['Doklad']);
		$this->assertArrayHasKey('Totoznost', $requestData['ZalozeniPredpisuDotaz']['Doklad']['Pacient']);
		$this->assertArrayHasKey('CP', $requestData['ZalozeniPredpisuDotaz']['Doklad']['Pacient']);
		$this->assertArrayHasKey('ZP', $requestData['ZalozeniPredpisuDotaz']['Doklad']['Pacient']);
		$this->assertArrayHasKey('Telefon', $requestData['ZalozeniPredpisuDotaz']['Doklad']['Pacient']);
		$this->assertArrayHasKey('Email', $requestData['ZalozeniPredpisuDotaz']['Doklad']['Pacient']);
		$this->assertArrayHasKey('Hmotnost', $requestData['ZalozeniPredpisuDotaz']['Doklad']['Pacient']);
		$this->assertArrayHasKey('Pohlavi', $requestData['ZalozeniPredpisuDotaz']['Doklad']['Pacient']);
		$this->assertArrayHasKey('Jmeno', $requestData['ZalozeniPredpisuDotaz']['Doklad']['Pacient']['Totoznost']);
		$this->assertArrayHasKey('Prijmeni', $requestData['ZalozeniPredpisuDotaz']['Doklad']['Pacient']['Totoznost']['Jmeno']);
		$this->assertArrayHasKey('Jmena', $requestData['ZalozeniPredpisuDotaz']['Doklad']['Pacient']['Totoznost']['Jmeno']);
		$this->assertArrayHasKey('DatumNarozeni', $requestData['ZalozeniPredpisuDotaz']['Doklad']['Pacient']['Totoznost']);
		$this->assertArrayHasKey('Adresa', $requestData['ZalozeniPredpisuDotaz']['Doklad']['Pacient']['Totoznost']);
		$this->assertArrayHasKey('NazevUlice', $requestData['ZalozeniPredpisuDotaz']['Doklad']['Pacient']['Totoznost']['Adresa']);
		$this->assertArrayHasKey('CisloPopisne', $requestData['ZalozeniPredpisuDotaz']['Doklad']['Pacient']['Totoznost']['Adresa']);
		$this->assertArrayHasKey('NazevObce', $requestData['ZalozeniPredpisuDotaz']['Doklad']['Pacient']['Totoznost']['Adresa']);
		$this->assertArrayHasKey('PSC', $requestData['ZalozeniPredpisuDotaz']['Doklad']['Pacient']['Totoznost']['Adresa']);
		$this->assertArrayHasKey('Predepisujici', $requestData['ZalozeniPredpisuDotaz']['Doklad']);
		$this->assertArrayHasKey('Pozn', $requestData['ZalozeniPredpisuDotaz']['Doklad']);
		$this->assertArrayHasKey('UpozornitLekare', $requestData['ZalozeniPredpisuDotaz']['Doklad']);
		$this->assertArrayHasKey('Stav', $requestData['ZalozeniPredpisuDotaz']['Doklad']);

		$this->assertSame(
			[
				'DatumVystaveni' => '2017-12-05',
				'PlatnostDo' => '2017-12-15',
				'Akutni' => 1,
				'Rodina' => 1,
				'Preshranicni' => 0,
				'Pacient' => [
					'Totoznost' => [
						'Jmeno' => [
							'Prijmeni' => 'Pesek',
							'Jmena' => 'Tomas',
						],
						'DatumNarozeni' => '1988-12-10',
						'Adresa' => [
							'NazevObce' => 'Pardubice',
							'PSC' => '53003',
							'NazevUlice' => 'Štrossova',
							'CisloPopisne' => '567',
						],
						'DruhDokladu' => 'OP',
						'CisloDokladu' => '1111111111',
						'ROB' => '',
					],
					'CP' => '8812101111',
					'ZP' => '111',
					'Telefon' => '774324030',
					'Email' => 'tomas@medoro.org',
					'Hmotnost' => 110.0,
					'Pohlavi' => 'M',
				],
				'Predepisujici' => [
					'Lekar' => '123',
					'Oddeleni' => '',
					'ICZ' => '1000000',
					'ICP' => '1000001',
					'PZS' => '',
					'Telefon' => '774324030',
					'Email' => 'tomas@medoro.org',
					'Odbornost' => '101',
				],
				'Pozn' => 'Comment',
				'UpozornitLekare' => 'Doctor alert',
				'Stav' => 'PREDEPSANY',
			],
			$requestData['ZalozeniPredpisuDotaz']['Doklad']
		);

		/*
		'Doporucujici' => [
					'Jmeno' => [
						'Prijmeni' => '',
						'Jmena' => '',
					],
					'PZS' => [
						'Nazev' => '',
						'ICZ' => '',
						'ICP' => '',
						'IC' => '',
						'DIC' => '',
						'Telefon' => '',
					],
					'Odbornost' => '',
				],
		*/
	}

}
