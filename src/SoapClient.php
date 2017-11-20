<?php declare(strict_types = 1);

namespace eRecept;

use eRecept\Cryptography\CryptographyService;
use eRecept\Driver\SoapClientDriver;

class SoapClient extends \SoapClient
{

	/** @var \eRecept\Configuration */
	private $configuration;

	/** @var \eRecept\Driver\SoapClientDriver */
	private $clientDriver;

	/** @var  \eRecept\Cryptography\CryptographyService */
	private $cryptoService;

	/** @var  bool */
	private $setSignature;

	public function __construct(Configuration $configuration, SoapClientDriver $clientDriver, CryptographyService $cryptographyService, bool $setSignature = false)
	{
		$this->clientDriver = $clientDriver;
		$this->configuration = $configuration;
		$this->cryptoService = $cryptographyService;
		$this->setSignature = $setSignature;

		$option = [
			'soap_version' => \SOAP_1_1,
			'encoding' => 'UTF-8',
			'trace' => true,
			'exceptions' => true,
			'cache_wsdl' => \WSDL_CACHE_DISK,
		];

		parent::__construct($this->configuration->getEnvironment()->getWsdlPath(), $option);
	}

	/**
	 * @param \eRecept\Method $method
	 * @param mixed[] $parameters
	 * @return mixed
	 */
	public function sendRequest(Method $method, array $parameters)
	{
		return $this->__soapCall($method->getValue(), $parameters);
	}

	/**
	 * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
	 * @param string $request
	 * @param string $location
	 * @param string $action
	 * @param int $version
	 * @param int $oneWay
	 * @return string|null
	 */
	public function __doRequest($request, $location, $action, $version, $oneWay = 0)
	{
		if ($this->setSignature) {
			$document = new \DOMDocument('1.0');
			$document->loadXML($request);

			$request = \sprintf(
				'<Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/"><Body>%s</Body></Envelope>',
				\str_replace('<?xml version="1.0"?>', '', $this->signatureDataElement($this->removeSignatureElement($document)))
			);
		}

		$response = $this->clientDriver->send($request, $location, $action, $version);
		if ($oneWay === 1) {
			return null;
		}
		return $response;
	}

	private function signatureDataElement(\DOMNode $messageElement): string
	{
		$messageDocument = new \DOMDocument('1.0');
		$newMessageElement = $messageDocument->importNode($messageElement, true);
		$messageDocument->appendChild($newMessageElement);

		return $this->cryptoService->addWSESignature($messageDocument);
	}

	private function removeSignatureElement(\DOMDocument $document): \DOMNode
	{
		$messageElement = $document->firstChild->firstChild->firstChild;
		$messageElement->removeChild($document->getElementsByTagName('Signature')->item(0));
		return $messageElement;
	}

}
