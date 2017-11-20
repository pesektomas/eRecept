<?php declare(strict_types = 1);

namespace eRecept\Request\Entity;

use eRecept\Request\Entity\Document\Document;

class CreatePrescription extends OnlyMessageEntity
{

	/** @var \eRecept\Request\Entity\Document\Document */
	private $document;

	/**
	 * Promenna slouzi k identifikaci editace pozadavku
	 *
	 * @var null|string
	 */
	private $previoslyDocumentId;

	/**
	 * Promenna slouzi k identifikaci editace pozadavku
	 *
	 * @var null|string
	 */
	private $previoslymessageId;

	public function __construct(
		Message $message,
		Document $document,
		?string $previoslyDocumentId = null,
		?string $previoslymessageId = null
	)
	{
		parent::__construct($message);

		$this->document = $document;
		$this->previoslyDocumentId = $previoslyDocumentId;
		$this->previoslymessageId = $previoslymessageId;
	}

	public function getDocument(): Document
	{
		return $this->document;
	}

	public function setPrevioslyDocumentId(string $previoslyDocumentId): void
	{
		$this->previoslyDocumentId = $previoslyDocumentId;
	}

	public function setPrevioslymessageId(string $previoslymessageId): void
	{
		$this->previoslymessageId = $previoslymessageId;
	}

	public function getPrevioslyDocumentId(): ?string
	{
		return $this->previoslyDocumentId;
	}

	public function getPrevioslymessageId(): ?string
	{
		return $this->previoslymessageId;
	}

}
