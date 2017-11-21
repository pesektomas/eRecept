<?php declare (strict_types = 1);

namespace eRecept\Response\Entity;

use DateTimeImmutable;

class VersionDocument
{

	/** @var string */
	private $version;

	/** @var string */
	private $prefix;

	/** @var string */
	private $description;

	/** @var \DateTimeImmutable */
	private $validityFrom;

	public function __construct(string $version, string $prefix, string $description, DateTimeImmutable $validityFrom)
	{
		$this->version = $version;
		$this->prefix = $prefix;
		$this->description = $description;
		$this->validityFrom = $validityFrom;
	}

	public function getVersion(): string
	{
		return $this->version;
	}

	public function getPrefix(): string
	{
		return $this->prefix;
	}

	public function getDescription(): string
	{
		return $this->description;
	}

	public function getValidityFrom(): DateTimeImmutable
	{
		return $this->validityFrom;
	}

}
