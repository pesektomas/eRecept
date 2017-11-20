<?php declare(strict_types = 1);

namespace eRecept\Exception;

use eRecept\Request\Request;

class FailedRequestException extends \Exception
{

	/** @var \eRecept\Request\Request */
	private $request;

	public function __construct(Request $request, \Throwable $previous)
	{
		parent::__construct('Request error: ' . $previous->getMessage(), $previous->getCode(), $previous);
		$this->request = $request;
	}

	public function getRequest(): Request
	{
		return $this->request;
	}

}
