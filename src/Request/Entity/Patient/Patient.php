<?php declare(strict_types = 1);

namespace eRecept\Request\Entity\Patient;

class Patient
{

	/**
	 * XML Jmena
	 *
	 * @var string[]
	 */
	private $names;

	/**
	 * XML Prijmeni
	 *
	 * @var string
	 */
	private $surname;

	/**
	 * XML DatumNarozeni
	 *
	 * @var \DateTimeImmutable
	 */
	private $dateOfBorn;

	/**
	 * XML Adresa
	 *
	 * @var \eRecept\Request\Entity\Patient\Address
	 */
	private $address;

	/**
	 * XML CP
	 *
	 * @var string
	 */
	private $insuranceNumber;

	/**
	 * XML ZP
	 *
	 * @var string
	 */
	private $insurance;

	/**
	 * XML Telefon
	 *
	 * @var string
	 */
	private $phone;

	/**
	 * XML Email
	 *
	 * @var string
	 */
	private $email;

	/**
	 * XML Notifikace
	 *
	 * @var null|\eRecept\Request\Entity\Patient\Notification
	 */
	private $notification;

	/**
	 * XML Veznice
	 *
	 * @var null|string
	 */
	private $prisone;

	/**
	 * XML Hmotnost
	 *
	 * @var float
	 */
	private $weight;

	/**
	 * XML Pohlavi
	 *
	 * @var \eRecept\Request\Entity\Patient\Sex
	 */
	private $sex;

	/**
	 * XML DruhDokladu
	 *
	 * @var null|string
	 */
	private $typeOfDocument;

	/**
	 * XML CisloDokladu
	 *
	 * @var null|string
	 */
	private $documentNumber;

	/**
	 * XML ROB
	 *
	 * @var null|string
	 */
	private $rob;

	/**
	 * @param string[] $names
	 * @param string $surname
	 * @param \DateTimeImmutable $dateOfBorn
	 * @param \eRecept\Request\Entity\Patient\Address $address
	 * @param string $insuranceNumber
	 * @param string $insurance
	 * @param string $phone
	 * @param string $email
	 * @param float $weight
	 * @param \eRecept\Request\Entity\Patient\Sex $sex
	 * @param null|\eRecept\Request\Entity\Patient\Notification $notification
	 * @param null|string $typeOfDocument
	 * @param null|string $documentNumber
	 * @param null|string $rob
	 * @param null|string $prisone
	 */
	public function __construct(
		array $names,
		string $surname,
		\DateTimeImmutable $dateOfBorn,
		Address $address,
		string $insuranceNumber,
		string $insurance,
		string $phone,
		string $email,
		float $weight,
		Sex $sex,
		?Notification $notification = null,
		?string $typeOfDocument = null,
		?string $documentNumber = null,
		?string $rob = null,
		?string $prisone = null
	)
	{
		$this->names = $names;
		$this->surname = $surname;
		$this->dateOfBorn = $dateOfBorn;
		$this->address = $address;
		$this->insuranceNumber = $insuranceNumber;
		$this->insurance = $insurance;
		$this->phone = $phone;
		$this->email = $email;
		$this->notification = $notification;
		$this->prisone = $prisone;
		$this->weight = $weight;
		$this->sex = $sex;
		$this->typeOfDocument = $typeOfDocument;
		$this->documentNumber = $documentNumber;
		$this->rob = $rob;
	}


	/**
	 * @return string[]
	 */
	public function getNames(): array
	{
		return $this->names;
	}

	public function getSurname(): string
	{
		return $this->surname;
	}

	public function getAddress(): Address
	{
		return $this->address;
	}

	public function getDateOfBorn(): \DateTimeImmutable
	{
		return $this->dateOfBorn;
	}

	public function getInsuranceNumber(): string
	{
		return $this->insuranceNumber;
	}

	public function getInsurance(): string
	{
		return $this->insurance;
	}

	public function getPhone(): string
	{
		return $this->phone;
	}

	public function getEmail(): string
	{
		return $this->email;
	}

	public function getNotification(): ?Notification
	{
		return $this->notification;
	}

	public function getPrisone(): ?string
	{
		return $this->prisone;
	}

	public function getWeight(): float
	{
		return $this->weight;
	}

	public function getSex(): Sex
	{
		return $this->sex;
	}

	public function getTypeOfDocument(): ?string
	{
		return $this->typeOfDocument;
	}

	public function getDocumentNumber(): ?string
	{
		return $this->documentNumber;
	}

	public function getRob(): ?string
	{
		return $this->rob;
	}

}
