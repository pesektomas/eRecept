<?php declare(strict_types = 1);

namespace eRecept\Exception;

class ClassNotFoundException extends \Exception
{

	/** @var string */
	private $className;

	public function __construct(string $className)
	{
		parent::__construct(\sprintf('Class %s was not found.', $className));
		$this->className = $className;
	}

	public function getClassName(): string
	{
		return $this->className;
	}

}
