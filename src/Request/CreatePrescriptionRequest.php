<?php declare (strict_types = 1);

namespace eRecept\Request;

use eRecept\Formatter;
use eRecept\Method;
use eRecept\Request\Entity\CreatePrescription;
use eRecept\UserPersonalData;

class CreatePrescriptionRequest implements Request
{

	/** @var string[] */
	protected $message;

	/** @var string[] */
	protected $document;

	public function __construct(CreatePrescription $createPrescription, UserPersonalData $personalData)
	{
		$this->message = $createPrescription->getMessageData();
		$this->document = [
			'DatumVystaveni' => Formatter::formatDate($createPrescription->getDocument()->getCreated()),
			'PlatnostDo' => Formatter::formatDate($createPrescription->getDocument()->getValidity()),
			'Akutni' => $createPrescription->getDocument()->isAcute() ? 1 : 0,
			'Rodina' => $createPrescription->getDocument()->isFamily() ? 1 : 0,
			'Preshranicni' => $createPrescription->getDocument()->isStranger() ? 1 : 0,
			'Pacient' => [
				'Totoznost' => [
					'Jmeno' => [
						'Prijmeni' => $createPrescription->getDocument()->getPatient()->getSurname(),
						'Jmena' => \implode(', ', $createPrescription->getDocument()->getPatient()->getNames()),
					],
					'DatumNarozeni' => $createPrescription->getDocument()->getPatient()->getDateOfBorn()->format('Y-m-d'),
					'Adresa' => [
						'NazevObce' => $createPrescription->getDocument()->getPatient()->getAddress()->getCity(),
						'PSC' => $createPrescription->getDocument()->getPatient()->getAddress()->getZipCode(),
					],
				],
				'CP' => $createPrescription->getDocument()->getPatient()->getInsuranceNumber(),
				'ZP' => $createPrescription->getDocument()->getPatient()->getInsurance(),
				'Telefon' => $createPrescription->getDocument()->getPatient()->getPhone(),
				'Email' => $createPrescription->getDocument()->getPatient()->getEmail(),
				'Hmotnost' => $createPrescription->getDocument()->getPatient()->getWeight(),
				'Pohlavi' => $createPrescription->getDocument()->getPatient()->getSex()->getValue(),
			],
			'Predepisujici' => [
				'Lekar' => $personalData->getUserUid(),
				'Oddeleni' => $createPrescription->getDocument()->getDoctor()->getDepartment(),
				'ICZ' => $createPrescription->getDocument()->getDoctor()->getIcz(),
				'ICP' => $createPrescription->getDocument()->getDoctor()->getIcp(),
				'PZS' => $createPrescription->getDocument()->getDoctor()->getPzs(),
				'Telefon' => $createPrescription->getDocument()->getDoctor()->getPhone(),
				'Email' => $createPrescription->getDocument()->getDoctor()->getMail(),
				'Odbornost' => $createPrescription->getDocument()->getDoctor()->getExpertise(),
			],
			'Pozn' => $createPrescription->getDocument()->getComment(),
			'UpozornitLekare' => $createPrescription->getDocument()->getDoctorAlert(),
			'Stav' => $createPrescription->getDocument()->getState()->getValue(),
		];

		if ($createPrescription->getDocument()->getPatient()->getNotification() !== null) {
			$this->document['Pacient']['Notifikace'] = $createPrescription->getDocument()->getPatient()->getNotification()->getValue();
		}
		if ($createPrescription->getDocument()->getRepeat() > 1) {
			$this->document['Opakovani'] = $createPrescription->getDocument()->getRepeat();
		}
		if ($createPrescription->getDocument()->getPatient()->getPrisone() !== null) {
			$this->document['Pacient']['Veznice'] = $createPrescription->getDocument()->getPatient()->getPrisone();
		}
		if ($createPrescription->getDocument()->getPatient()->getTypeOfDocument() !== null) {
			$this->document['Pacient']['Totoznost']['DruhDokladu'] = $createPrescription->getDocument()->getPatient()->getTypeOfDocument();
		}
		if ($createPrescription->getDocument()->getPatient()->getDocumentNumber() !== null) {
			$this->document['Pacient']['Totoznost']['CisloDokladu'] = $createPrescription->getDocument()->getPatient()->getDocumentNumber();
		}
		if ($createPrescription->getDocument()->getPatient()->getRob() !== null) {
			$this->document['Pacient']['Totoznost']['ROB'] = $createPrescription->getDocument()->getPatient()->getRob();
		}

		if ($createPrescription->getDocument()->getPatient()->getAddress()->getStreet() !== null) {
			$this->document['Pacient']['Totoznost']['Adresa']['NazevUlice'] = $createPrescription->getDocument()->getPatient()->getAddress()->getStreet();
		}
		if ($createPrescription->getDocument()->getPatient()->getAddress()->getHouseNumber() !== null) {
			$this->document['Pacient']['Totoznost']['Adresa']['CisloPopisne'] = $createPrescription->getDocument()->getPatient()->getAddress()->getHouseNumber();
		}
		if ($createPrescription->getDocument()->getPatient()->getAddress()->getRegistrationNumber() !== null) {
			$this->document['Pacient']['Totoznost']['Adresa']['CisloEvidencni'] = $createPrescription->getDocument()->getPatient()->getAddress()->getRegistrationNumber();
		}
		if ($createPrescription->getDocument()->getPatient()->getAddress()->getOrientationNumber() !== null) {
			$this->document['Pacient']['Totoznost']['Adresa']['CisloOrientacni'] = $createPrescription->getDocument()->getPatient()->getAddress()->getOrientationNumber();
		}
		if ($createPrescription->getDocument()->getPatient()->getAddress()->getCityPartName() !== null) {
			$this->document['Pacient']['Totoznost']['Adresa']['NazevCastiObce'] = $createPrescription->getDocument()->getPatient()->getAddress()->getCityPartName();
		}
		if ($createPrescription->getDocument()->getPatient()->getAddress()->getDistrict() !== null) {
			$this->document['Pacient']['Totoznost']['Adresa']['NazevOkresu'] = $createPrescription->getDocument()->getPatient()->getAddress()->getDistrict();
		}

		/** @var \eRecept\Request\Entity\Medicine\Medicine */
		foreach ($createPrescription->getDocument()->getMedicines() as $medicine) {
			$insertMedicine = [
				'Mnozstvi' => $medicine->getQuantity(),
				'Navod' => $medicine->getInstruction(),
				'Uhrada' => $medicine->getPayment()->getValue(),
				'ID_LP_Zdroj' => '',
			];

			$arrayKey = null;
			$medicineInfo = null;
			if ($medicine->getRegisterMedicine() !== null) {
				$arrayKey = 'HVLPReg';
				$medicineInfo = $medicine->getRegisterMedicine();
			} elseif ($medicine->getNonregisterMedicine() !== null) {
				$arrayKey = 'HVLPNereg';
				$medicineInfo = $medicine->getNonregisterMedicine();
			}

			if ($arrayKey !== null && $medicineInfo !== null) {
				$insertMedicine[$arrayKey] = [
					'Nazev' => $medicineInfo->getName(),
				];

				if ($medicineInfo->getCode()) {
					$insertMedicine[$arrayKey]['Kod'] = $medicineInfo->getCode();
				}
				if ($medicineInfo->getAtc()) {
					$insertMedicine[$arrayKey]['ATC'] = $medicineInfo->getAtc();
				}
				if ($medicineInfo->getForm()) {
					$insertMedicine[$arrayKey]['Forma'] = $medicineInfo->getForm();
				}
				if ($medicineInfo->getPower()) {
					$insertMedicine[$arrayKey]['Sila'] = $medicineInfo->getPower();
				}
				if ($medicineInfo->getApplicationForm()) {
					$insertMedicine[$arrayKey]['CestaPodani'] = $medicineInfo->getApplicationForm();
				}
				if ($medicineInfo->getPackage()) {
					$insertMedicine[$arrayKey]['Baleni'] = $medicineInfo->getPackage();
				}
			}

			// IPLP, INN

			if ($medicine->getNotChange() !== null) {
				$insertMedicine['Nezamenovat'] = $medicine->getNotChange();
			}
			if ($medicine->getSkip() !== null) {
				$insertMedicine['Prekroceni'] = $medicine->getSkip();
			}
			if ($medicine->getRequestZP() !== null) {
				$insertMedicine['ZadankaZP'] = $medicine->getRequestZP();
			}

			$this->document['PLP'][] = $insertMedicine;
		}
	}

	/**
	 * @return mixed[]
	 */
	public function getData(): array
	{
		return [
			'ZalozeniPredpisuDotaz' => [
				'Zprava' => $this->message,
				'Doklad' => $this->document,
				'Signature' => null,
			],
		];
	}

	public function getMethod(): Method
	{
		return Method::get(Method::METHOD_CREATE_PRESCRIPTION);
	}

}
