<?php declare (strict_types = 1);

namespace eRecept\Response;

use DateTimeImmutable;
use eRecept\Response\Entity\VersionDocument;

class NacistVerzeResponse implements Response
{

	/** @var string */
	private $version;

	/** @var string */
	private $name;

	/** @var \eRecept\Response\Entity\VersionDocument[] */
	private $documents;

	public function parse(\stdClass $soapResponse): void
	{
		$this->version = $soapResponse->Verze;
		$this->name = $soapResponse->Nazev;

		foreach ($soapResponse->Doklad as $document) {
			$this->documents[] = new VersionDocument(
				$document->Verze,
				$document->Prefix,
				$document->Popis,
				new DateTimeImmutable($document->PlatOd)
			);
		}
	}

	public function isValid(): bool
	{
		return !empty($this->documents);
	}

	public function getVersion(): string
	{
		return $this->version;
	}

	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @return \eRecept\Response\Entity\VersionDocument[]
	 */
	public function getDocuments(): array
	{
		return $this->documents;
	}

}
