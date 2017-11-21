<?php declare (strict_types = 1);

namespace eRecept\Response\Entity;

class ErrorCode
{

	/** @var string */
	private $code;

	/** @var string */
	private $group;

	/** @var string */
	private $description;

	/** @var string */
	private $recommendation;

	public function __construct(string $code, string $group, string $description, string $recommendation)
	{
		$this->code = $code;
		$this->group = $group;
		$this->description = $description;
		$this->recommendation = $recommendation;
	}

	public function getCode(): string
	{
		return $this->code;
	}

	public function getGroup(): string
	{
		return $this->group;
	}

	public function getDescription(): string
	{
		return $this->description;
	}

	public function getRecommendation(): string
	{
		return $this->recommendation;
	}

}
