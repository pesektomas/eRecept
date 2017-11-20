<?php declare(strict_types = 1);

namespace eRecept\Request;

use eRecept\Request\Entity\AppPingZEP;

class AppPingZepRequest implements Request
{

	/** @var mixed[] */
	private $message;

	public function __construct(AppPingZEP $appPingZep)
	{
		$this->message = $appPingZep->getMessageData();
	}

	/**
	 * @return mixed[]
	 */
	public function getData(): array
	{
		return [
			'AppPingZEPDotaz' => [
				'Zprava' => $this->message,
				'Signature' => null,
			],
		];
	}

}
