<?php declare (strict_types = 1);

namespace eRecept;

class UserPersonalData
{

	/** @var string */
	private $privateKey;

	/** @var string */
	private $privateKeyPassword;

	/** @var string */
	private $certificate;

	/** @var string */
	private $userUid;

	/** @var string */
	private $userPassword;

	public function __construct(string $privateKey, string $privateKeyPassword, string $certificate, string $userUid, string $userPassword)
	{
		$this->privateKey = $privateKey;
		$this->privateKeyPassword = $privateKeyPassword;
		$this->certificate = $certificate;
		$this->userUid = $userUid;
		$this->userPassword = $userPassword;
	}

	public function getPrivateKey(): string
	{
		return $this->privateKey;
	}

	public function getPrivateKeyPassword(): string
	{
		return $this->privateKeyPassword;
	}

	public function getCertificate(): string
	{
		return $this->certificate;
	}

	public function getUserUid(): string
	{
		return $this->userUid;
	}

	public function getUserPassword(): string
	{
		return $this->userPassword;
	}

}
