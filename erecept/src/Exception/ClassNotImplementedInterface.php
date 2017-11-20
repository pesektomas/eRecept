<?php declare(strict_types = 1);

namespace eRecept\Exception;

class ClassNotImplementedInterface extends \Exception
{

	/** @var string */
	private $className;

	/** @var string */
	private $interfaceName;

	public function __construct(string $className, string $interfaceName)
	{
		parent::__construct(\sprintf('Class %s not implemented %s interface.', $className, $interfaceName));
		$this->className = $className;
		$this->interfaceName = $interfaceName;
	}

	public function getClassName(): string
	{
		return $this->className;
	}

	public function getInterfaceName(): string
	{
		return $this->interfaceName;
	}

}
