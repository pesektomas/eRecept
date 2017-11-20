<?php declare(strict_types = 1);

namespace eRecept\Request\Entity\Medicine;

class Medicine
{

	/** @var  int */
	private $quantity;

	/** @var string */
	private $instruction;

	/** @var null|string */
	private $diagnose;

	/** @var null|\eRecept\Request\Entity\Medicine\MedicineInfo */
	private $registerMedicine;

	/** @var null|\eRecept\Request\Entity\Medicine\MedicineInfo */
	private $nonregisterMedicine;

	/** @var \eRecept\Request\Entity\Medicine\MedicinePayment */
	private $payment;

	/** @var int */
	private $medicineSource;

	/** @var null|bool */
	private $notChange;

	/** @var null|bool */
	private $skip;

	/** @var null|string */
	private $requestZP;

	public function __construct(
		int $quantity,
		string $instruction,
		MedicinePayment $payment,
		int $medicineSource,
		?MedicineInfo $registerMedicine = null,
		?MedicineInfo $nonregisterMedicine = null,
		?string $diagnose = null,
		?bool $notChange = null,
		?bool $skip = null,
		?string $requestZP = null
	)
	{
		$this->quantity = $quantity;
		$this->instruction = $instruction;
		$this->diagnose = $diagnose;
		$this->registerMedicine = $registerMedicine;
		$this->nonregisterMedicine = $nonregisterMedicine;
		$this->payment = $payment;
		$this->medicineSource = $medicineSource;
		$this->notChange = $notChange;
		$this->skip = $skip;
		$this->requestZP = $requestZP;
	}

	public function getQuantity(): int
	{
		return $this->quantity;
	}

	public function getInstruction(): string
	{
		return $this->instruction;
	}

	public function getDiagnose(): ?string
	{
		return $this->diagnose;
	}

	public function getPayment(): MedicinePayment
	{
		return $this->payment;
	}

	public function getMedicineSource(): int
	{
		return $this->medicineSource;
	}

	public function getNonregisterMedicine(): ?MedicineInfo
	{
		return $this->nonregisterMedicine;
	}

	public function getRegisterMedicine(): ?MedicineInfo
	{
		return $this->registerMedicine;
	}

	public function getNotChange(): ?bool
	{
		return $this->notChange;
	}

	public function getRequestZP(): ?string
	{
		return $this->requestZP;
	}

	public function getSkip(): ?bool
	{
		return $this->skip;
	}

}
