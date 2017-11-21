<?php declare (strict_types = 1);

namespace eRecept\Request\Entity;

class CancelPrescription extends OnlyMessageEntity
{

	/** @var string */
	private $user;

	/** @var string */
	private $workplace;

	/** @var string */
	private $documentId;

	/** @var \DateTimeImmutable */
	private $cancelDate;

	/** @var string */
	private $cancelReason;

	/** @var string|null */
	private $authorizationId;

	public function __construct(
		Message $message,
		string $user,
		string $workplace,
		string $documentId,
		\DateTimeImmutable $cancelDate,
		string $cancelReason,
		?string $authorizationId = null
	)
	{
		parent::__construct($message);

		$this->user = $user;
		$this->workplace = $workplace;
		$this->documentId = $documentId;
		$this->cancelDate = $cancelDate;
		$this->cancelReason = $cancelReason;
		$this->authorizationId = $authorizationId;
	}

	public function getUser(): string
	{
		return $this->user;
	}

	public function getWorkplace(): string
	{
		return $this->workplace;
	}

	public function getDocumentId(): string
	{
		return $this->documentId;
	}

	public function getCancelDate(): \DateTimeImmutable
	{
		return $this->cancelDate;
	}

	public function getCancelReason(): string
	{
		return $this->cancelReason;
	}

	public function getAuthorizationId(): ?string
	{
		return $this->authorizationId;
	}

}
