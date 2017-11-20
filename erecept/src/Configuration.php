<?php declare(strict_types = 1);

namespace eRecept;

class Configuration
{

	/** @var  \eRecept\Environment */
	private $environment;

	/** @var  string */
	private $version;

	/** @var  string */
	private $clientSw;

	/** @var string */
	private $httpsCertificate;

	/** @var string */
	private $httpsCertificatePassword;

	public function __construct(Environment $environment, string $version, string $clientSw, string $httpsCertificate, string $httpsCertificatePassword)
	{
		$this->environment = $environment;
		$this->version = $version;
		$this->clientSw = $clientSw;
		$this->httpsCertificate = $httpsCertificate;
		$this->httpsCertificatePassword = $httpsCertificatePassword;
	}

	public function getEnvironment(): Environment
	{
		return $this->environment;
	}

	public function getVersion(): string
	{
		return $this->version;
	}

	public function getClientSw(): string
	{
		return $this->clientSw;
	}

	public function getHttpsCertificate(): string
	{
		return $this->httpsCertificate;
	}

	public function getHttpsCertificatePassword(): string
	{
		return $this->httpsCertificatePassword;
	}

}
