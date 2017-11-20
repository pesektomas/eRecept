<?php declare(strict_types = 1);

namespace eRecept\Request\Entity\Patient;

class Address
{

	/**
	 * XML NazevUlice
	 *
	 * @var null|string
	 * */
	private $street;

	/**
	 * XML CisloPopisne
	 *
	 * @var null|string
	 * */
	private $houseNumber;

	/**
	 * XML NazevObce
	 *
	 * @var string
	 * */
	private $city;

	/**
	 * XML PSC
	 *
	 * @var string
	 * */
	private $zipCode;

	/**
	 * XML CisloEvidencni
	 *
	 * @var null|string
	 */
	private $registrationNumber;

	/**
	 * XML CisloOrientacni
	 *
	 * @var null|string
	 */
	private $orientationNumber;

	/**
	 * XML NazevCastiObce
	 *
	 * @var null|string
	 */
	private $cityPartName;

	/**
	 * XML NazevOkresu
	 *
	 * @var null|string
	 */
	private $district;

	public function __construct(
		string $city,
		string $zipCode,
		?string $street = null,
		?string $houseNumber = null,
		?string $registrationNumber = null,
		?string $orientationNumber = null,
		?string $cityPartName = null,
		?string $district = null
	)
	{
		$this->street = $street;
		$this->houseNumber = $houseNumber;
		$this->city = $city;
		$this->zipCode = $zipCode;
		$this->registrationNumber = $registrationNumber;
		$this->orientationNumber = $orientationNumber;
		$this->cityPartName = $cityPartName;
		$this->district = $district;
	}

	public function getStreet(): ?string
	{
		return $this->street;
	}

	public function getHouseNumber(): ?string
	{
		return $this->houseNumber;
	}

	public function getCity(): string
	{
		return $this->city;
	}

	public function getZipCode(): string
	{
		return $this->zipCode;
	}

	public function getRegistrationNumber(): ?string
	{
		return $this->registrationNumber;
	}

	public function getOrientationNumber(): ?string
	{
		return $this->orientationNumber;
	}

	public function getCityPartName(): ?string
	{
		return $this->cityPartName;
	}

	public function getDistrict(): ?string
	{
		return $this->district;
	}

}
