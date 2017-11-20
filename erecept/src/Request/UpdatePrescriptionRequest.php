<?php declare (strict_types = 1);

namespace eRecept\Request;

use eRecept\Request\Entity\CreatePrescription;
use eRecept\UserPersonalData;

class UpdatePrescriptionRequest extends CreatePrescriptionRequest implements Request
{

	public function __construct(CreatePrescription $createPrescription, UserPersonalData $personalData)
	{
		parent::__construct($createPrescription, $personalData);

		if ($createPrescription->getPrevioslyDocumentId() !== null && $createPrescription->getPrevioslymessageId() !== null) {
			$this->document['ID_Dokladu'] = $createPrescription->getPrevioslyDocumentId();
			$this->document['AutorizacniID'] = $createPrescription->getPrevioslymessageId();
		} else {
			throw new \Exception('Bad parameters');
		}
	}

	/**
	 * @return mixed[]
	 */
	public function getData(): array
	{
		return [
			'ZmenaPredpisuDotaz' => [
				'Zprava' => $this->message,
				'Doklad' => $this->document,
				'Signature' => null,
			],
		];
	}

}
