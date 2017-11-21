<?php declare(strict_types = 1);

namespace eRecept\Request\Entity;

use eRecept\Formatter;

class OnlyMessageEntity
{

	/** @var  \eRecept\Request\Entity\Message */
	private $message;

	public function __construct(Message $message)
	{
		$this->message = $message;
	}

	public function getMessage(): Message
	{
		return $this->message;
	}

	/**
	 * @return string[]
	 */
	public function getMessageData(): array
	{
		return [
			'ID_Zpravy' => $this->message->getMessageId(),
			'Verze' => $this->message->getVersion()->getValue(),
			'Odeslano' => Formatter::formatDateTime($this->message->getSent()),
			'SW_Klienta' => $this->message->getClientSw(),
		];
	}

}
