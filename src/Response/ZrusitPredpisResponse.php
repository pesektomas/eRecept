<?php declare (strict_types = 1);

namespace eRecept\Response;

class ZrusitPredpisResponse implements Response
{

	/** @var string */
	private $documentId;

	public function parse(\stdClass $soapResponse): void
	{
		$this->documentId = $soapResponse->Doklad->ID_Dokladu;
	}

	public function isValid(): bool
	{
		return $this->documentId !== null;
	}

}
