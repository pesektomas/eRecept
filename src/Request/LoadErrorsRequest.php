<?php declare (strict_types = 1);

namespace eRecept\Request;

use eRecept\Method;
use eRecept\Request\Entity\OnlyMessageEntity;

class LoadErrorsRequest implements Request
{

	/** @var mixed[] */
	private $message;

	public function __construct(OnlyMessageEntity $messageEntity)
	{
		$this->message = $messageEntity->getMessageData();
	}


	/**
	 * @return mixed[]
	 */
	public function getData(): array
	{
		return [
			'CisChybDotaz' => [
				'Zprava' => $this->message,
			],
		];
	}

	public function getMethod(): Method
	{
		return Method::get(Method::METHOD_LOAD_ERRORS);
	}

}
