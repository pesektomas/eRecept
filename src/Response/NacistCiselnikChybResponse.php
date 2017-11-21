<?php declare (strict_types = 1);

namespace eRecept\Response;

use eRecept\Response\Entity\ErrorCode;

class NacistCiselnikChybResponse implements Response
{

	/** @var \eRecept\Response\Entity\ErrorCode[] */
	private $errorsCode;

	public function parse(\stdClass $soapResponse): void
	{
		foreach ($soapResponse->Chyba as $error) {
			$this->errorsCode[] = new ErrorCode(
				$error->Kod,
				$error->Skupina,
				$error->Popis,
				$error->Doporuceni
			);
		}
	}

	public function isValid(): bool
	{
		return !empty($this->errorsCode);
	}

	/**
	 * @return \eRecept\Response\Entity\ErrorCode[]
	 */
	public function getErrorsCode(): array
	{
		return $this->errorsCode;
	}

}
