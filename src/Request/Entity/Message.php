<?php declare(strict_types = 1);

namespace eRecept\Request\Entity;

use eRecept\EreceptVersion;

class Message
{

	/**
	 * XML ID_Zpravy
	 *
	 * @var  \Ramsey\Uuid\UuidInterface
	 */
	private $messageId;

	/**
	 * XML Verze
	 *
	 * @var \eRecept\EreceptVersion
	 */
	private $version;

	/**
	 * XML Odeslano
	 *
	 * @var  \DateTimeImmutable
	 */
	private $sent;

	/**
	 * XML SW_Klienta
	 *
	 * @var  string
	 */
	private $clientSw;

	public function __construct(EreceptVersion $version, \DateTimeImmutable $sent, string $clientSw)
	{
		$this->messageId = \Ramsey\Uuid\Uuid::uuid4();
		$this->version = $version;
		$this->sent = $sent;
		$this->clientSw = $clientSw;
	}

	public function getMessageId(): \Ramsey\Uuid\UuidInterface
	{
		return $this->messageId;
	}

	public function getVersion(): EreceptVersion
	{
		return $this->version;
	}

	public function getSent(): \DateTimeImmutable
	{
		return $this->sent;
	}

	public function getClientSw(): string
	{
		return $this->clientSw;
	}

}
