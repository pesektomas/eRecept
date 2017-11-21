<?php declare (strict_types = 1);

namespace eRecept\Request;

use eRecept\Formatter;
use eRecept\Method;
use eRecept\Request\Entity\CancelPrescription;

class CancelPrescriptionRequest implements Request
{

	/** @var string[] */
	protected $message;

	/** @var string[] */
	protected $document;

	public function __construct(CancelPrescription $cancelPrescription)
	{
		$this->message = $cancelPrescription->getMessageData();
		$this->document = [
			'Uzivatel' => $cancelPrescription->getUser(),
			'Pracoviste' => $cancelPrescription->getWorkplace(),
			'ID_Dokladu' => $cancelPrescription->getDocumentId(),
			'DatumZruseni' => Formatter::formatDate($cancelPrescription->getCancelDate()),
			'DuvodZruseni' => $cancelPrescription->getCancelReason(),
		];

		if ($cancelPrescription->getAuthorizationId() !== null) {
			$this->document['AutorizacniID'] = $cancelPrescription->getAuthorizationId();
		}
	}

	/**
	 * @return mixed[]
	 */
	public function getData(): array
	{
		return [
			'ZruseniPredpisuDotaz' => [
				'Zprava' => $this->message,
				'Doklad' => $this->document,
			],
		];
	}

	public function getMethod(): Method
	{
		return Method::get(Method::METHOD_CANCEL_PRESCRIPTION);
	}

}
