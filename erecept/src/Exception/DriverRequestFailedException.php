<?php declare(strict_types = 1);

namespace eRecept\Exception;

class DriverRequestFailedException extends \Exception
{

	public function __construct(\Throwable $e)
	{
		parent::__construct($e->getMessage(), $e->getCode(), $e);
	}

}
