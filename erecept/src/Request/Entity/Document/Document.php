<?php declare(strict_types = 1);

namespace eRecept\Request\Entity\Document;

use eRecept\Request\Entity\Patient\Patient;

class Document
{

	/** @var \DateTimeImmutable */
	private $created;

	/** @var \DateTimeImmutable */
	private $validity;

	/** @var bool */
	private $acute;

	/** @var bool */
	private $family;

	/** @var bool */
	private $stranger;

	/** @var int */
	private $repeat;

	/** @var \eRecept\Request\Entity\Patient\Patient */
	private $patient;

	/** @var \eRecept\Request\Entity\Document\Doctor */
	private $doctor;

	/** @var \eRecept\Request\Entity\Medicine\Medicine[] */
	private $medicines;

	/** @var string */
	private $comment;

	/** @var string */
	private $doctorAlert;

	/** @var \eRecept\Request\Entity\Document\DocumentState */
	private $state;

	/**
	 * @param \DateTimeImmutable $created
	 * @param \DateTimeImmutable $validity
	 * @param bool $acute
	 * @param bool $family
	 * @param bool $stranger
	 * @param \eRecept\Request\Entity\Patient\Patient $patient
	 * @param \eRecept\Request\Entity\Document\Doctor $doctor
	 * @param \eRecept\Request\Entity\Medicine\Medicine[] $medicines
	 * @param string $comment
	 * @param string $doctorAlert
	 * @param \eRecept\Request\Entity\Document\DocumentState $state
	 * @param int $repeat
	 */
	public function __construct(
		\DateTimeImmutable $created,
		\DateTimeImmutable $validity,
		bool $acute,
		bool $family,
		bool $stranger,
		Patient $patient,
		Doctor $doctor,
		array $medicines,
		string $comment,
		string $doctorAlert,
		DocumentState $state,
		int $repeat = 1
	)
	{
		$this->created = $created;
		$this->validity = $validity;
		$this->acute = $acute;
		$this->family = $family;
		$this->stranger = $stranger;
		$this->repeat = $repeat;
		$this->patient = $patient;
		$this->doctor = $doctor;
		$this->medicines = $medicines;
		$this->comment = $comment;
		$this->doctorAlert = $doctorAlert;
		$this->state = $state;
	}

	public function getCreated(): \DateTimeImmutable
	{
		return $this->created;
	}

	public function getValidity(): \DateTimeImmutable
	{
		return $this->validity;
	}

	public function isFamily(): bool
	{
		return $this->family;
	}

	public function getPatient(): Patient
	{
		return $this->patient;
	}

	public function getDoctor(): Doctor
	{
		return $this->doctor;
	}

	/**
	 * @return \eRecept\Request\Entity\Medicine\Medicine[]
	 */
	public function getMedicines(): array
	{
		return $this->medicines;
	}

	public function getComment(): string
	{
		return $this->comment;
	}

	public function getDoctorAlert(): string
	{
		return $this->doctorAlert;
	}

	public function getState(): DocumentState
	{
		return $this->state;
	}

	public function isAcute(): bool
	{
		return $this->acute;
	}

	public function isStranger(): bool
	{
		return $this->stranger;
	}

	public function getRepeat(): int
	{
		return $this->repeat;
	}

}
