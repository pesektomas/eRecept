<?php declare(strict_types = 1);

namespace eRecept\Request\Entity\Medicine;

class MedicineInfo
{

	/** @var string */
	private $name;

	/** @var null|string */
	private $code;

	/** @var null|string */
	private $atc;

	/** @var null|string */
	private $form;

	/** @var null|string */
	private $power;

	/** @var null|string */
	private $applicationForm;

	/** @var null|string */
	private $package;

	public function __construct(
		string $name,
		?string $code = null,
		?string $atc = null,
		?string $form = null,
		?string $power = null,
		?string $applicationForm = null,
		?string $package = null
	)
	{
		$this->code = $code;
		$this->atc = $atc;
		$this->name = $name;
		$this->form = $form;
		$this->power = $power;
		$this->applicationForm = $applicationForm;
		$this->package = $package;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getCode(): ?string
	{
		return $this->code;
	}

	public function getAtc(): ?string
	{
		return $this->atc;
	}

	public function getForm(): ?string
	{
		return $this->form;
	}

	public function getPower(): ?string
	{
		return $this->power;
	}

	public function getApplicationForm(): ?string
	{
		return $this->applicationForm;
	}

	public function getPackage(): ?string
	{
		return $this->package;
	}

}
