<?php declare(strict_types = 1);

namespace eRecept\Request\Entity\Document;

class Doctor
{

	/**
	 * XML ICP
	 *
	 * @var string
	 */
	private $icp;

	/**
	 * XML PZS
	 *
	 * @var string
	 */
	private $pzs;

	/**
	 * XML Telefon
	 *
	 * @var string
	 */
	private $phone;

	/**
	 * XML Odbornost
	 *
	 * @var string
	 */
	private $expertise;

	/**
	 * XML Oddeleni
	 *
	 * @var string
	 */
	private $department;

	/**
	 * XML ICZ
	 *
	 * @var string
	 */
	private $icz;

	/**
	 * XML Email
	 *
	 * @var string
	 */
	private $mail;

	public function __construct(
		string $icp,
		string $pzs,
		string $phone,
		string $expertise,
		string $department,
		string $icz,
		string $mail
	)
	{
		$this->icp = $icp;
		$this->pzs = $pzs;
		$this->phone = $phone;
		$this->expertise = $expertise;
		$this->department = $department;
		$this->icz = $icz;
		$this->mail = $mail;
	}

	public function getIcp(): string
	{
		return $this->icp;
	}

	public function getPzs(): string
	{
		return $this->pzs;
	}

	public function getPhone(): string
	{
		return $this->phone;
	}

	public function getExpertise(): string
	{
		return $this->expertise;
	}

	public function getDepartment(): string
	{
		return $this->department;
	}

	public function getIcz(): string
	{
		return $this->icz;
	}

	public function getMail(): string
	{
		return $this->mail;
	}

}
