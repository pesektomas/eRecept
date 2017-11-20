<?php declare(strict_types = 1);

namespace eRecept\Exception;

class BadParameterException extends \Exception
{

	public function __construct(string $parameter, string $objectName)
	{
		parent::__construct(\sprintf('Parameter %s was not found in object %s.', $parameter, $objectName));
	}

}
