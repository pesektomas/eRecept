<?php declare(strict_types = 1);

namespace eRecept;

use eRecept\Cryptography\CryptographyService;
use eRecept\Driver\SoapClientDriver;
use eRecept\Exception\DriverRequestFailedException;
use eRecept\Exception\FailedRequestException;
use eRecept\Request\Request;
use eRecept\Response\Response;
use eRecept\Response\ResponseLoader;

class Client
{

	/** @var \eRecept\SoapClient|null */
	private $soapClient;

	/** @var \eRecept\Driver\SoapClientDriver */
	private $soapClientDriver;

	/** @var \eRecept\Cryptography\CryptographyService  */
	private $cryptService;

	/** @var \eRecept\Configuration */
	private $configuration;

	/** @var  bool */
	private $setSignature;

	public function __construct(Configuration $configuration, SoapClientDriver $soapClientDriver, CryptographyService $cryptographyService, bool $setSignature = false)
	{
		$this->soapClientDriver = $soapClientDriver;
		$this->configuration = $configuration;
		$this->cryptService = $cryptographyService;
		$this->setSignature = $setSignature;
	}

	public function send(Request $request): Response
	{
		try {
			$soapResponse = $this->getSoapClient()->sendRequest($request->getMethod(), $request->getData());
		} catch (DriverRequestFailedException $e) {
			throw new FailedRequestException($request, $e);
		} catch (\SoapFault $e) {
			throw new FailedRequestException($request, $e);
		}

		$responseCls = ResponseLoader::loadResponse($request->getMethod());
		$responseCls->parse($soapResponse);

		return $responseCls;
	}

	private function getSoapClient(): SoapClient
	{
		if ($this->soapClient === null) {
			$this->soapClient = new SoapClient($this->configuration, $this->soapClientDriver, $this->cryptService, $this->setSignature);
		}
		return $this->soapClient;
	}

}
