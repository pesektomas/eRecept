<?php declare(strict_types = 1);

namespace eRecept\Request;

use eRecept\Request\Entity\AppPing;

class AppPingRequest implements Request
{

	/** @var mixed[] */
	private $message;

	public function __construct(AppPing $appPing)
	{
		$this->message = $appPing->getMessageData();
	}

	/**
	 * @return mixed[]
	 */
	public function getData(): array
	{
		return [
			'AppPingDotaz' => [
				'Zprava' => $this->message,
			],
		];
	}

	/**
	 * @return mixed[]
	 */
	public function getMessage(): array
	{
		return $this->message;
	}

}
