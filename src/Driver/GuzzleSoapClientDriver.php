<?php declare(strict_types = 1);

namespace eRecept\Driver;

use eRecept\Exception\DriverRequestFailedException;

class GuzzleSoapClientDriver implements SoapClientDriver
{

	private const DEFAULT_TIMEOUT = 5;
	private const HEADER_USER_AGENT = 'PHP';

	/** @var \GuzzleHttp\Client */
	private $httpClient;

	/** @var float */
	private $connectionTimeout;

	/** @var float */
	private $requestTimeout;

	/** @var  string */
	private $authorization;

	public function __construct(\GuzzleHttp\Client $httpClient, string $authorization, float $connectionTimeout = self::DEFAULT_TIMEOUT, float $requestTimeout = self::DEFAULT_TIMEOUT)
	{
		$this->httpClient = $httpClient;
		$this->connectionTimeout = $connectionTimeout;
		$this->requestTimeout = $requestTimeout;
		$this->authorization = $authorization;
	}
	public function send(string $request, string $location, string $action, int $soapVersion): string
	{
		$headers = [
			'User-Agent' => self::HEADER_USER_AGENT,
			'Content-Type' => \sprintf('%s; charset=utf-8', $soapVersion === 2 ? 'application/soap+xml' : 'text/xml'),
			'SOAPAction' => $action,
			'Content-Length' => \strlen($request),
			'Authorization' => $this->authorization,
		];

		$request = new \GuzzleHttp\Psr7\Request('POST', $location, $headers, $request);
		try {
			$httpResponse = $this->httpClient->send($request, [
				\GuzzleHttp\RequestOptions::HTTP_ERRORS => false,
				\GuzzleHttp\RequestOptions::ALLOW_REDIRECTS => false,
				\GuzzleHttp\RequestOptions::CONNECT_TIMEOUT => $this->connectionTimeout,
				\GuzzleHttp\RequestOptions::TIMEOUT => $this->requestTimeout,
			]);
			return (string) $httpResponse->getBody();
		} catch (\GuzzleHttp\Exception\RequestException $e) {
			throw new DriverRequestFailedException($e);
		}
	}

}
