<?php declare(strict_types = 1);

namespace eRecept\Response;

class ZalozitPredpisResponse implements Response
{

	/**
	 * V kooperaci s documentId slouzi k pozdejsi zmene predpisu
	 *
	 * @var string
	 */
	protected $messageId;

	/**
	 * V kooperaci s messageId slouzi k pozdejsi zmene predpisu
	 *
	 * @var string
	 */
	protected $documentId;

	/** @var string */
	protected $medicineId;

	/** @var string */
	protected $sendId;

	/** @var \DateTime */
	protected $acceptDate;

	public function parse(\stdClass $soapResponse): void
	{
		$this->messageId = $soapResponse->Zprava->ID_Zpravy;
		$this->documentId = $soapResponse->Doklad->ID_Dokladu;
		$this->medicineId = $soapResponse->Doklad->LP->ID_LP;
		$this->sendId = $soapResponse->Zprava->ID_Zpravy;
		$this->acceptDate = new \DateTime($soapResponse->Zprava->Prijato);
	}

	public function isValid(): bool
	{
		return $this->documentId !== null && \strlen($this->documentId) === 12;
	}

	public function getMessageId(): string
	{
		return $this->messageId;
	}

	public function getDocumentId(): string
	{
		return $this->documentId;
	}

}
