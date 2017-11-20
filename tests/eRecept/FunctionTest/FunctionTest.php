<?php declare (strict_types = 1);

namespace eRecept\FunctionTest;

use Nette\Neon\Neon;
use eRecept\Client;
use eRecept\Configuration;
use eRecept\Cryptography\CryptographyService;
use eRecept\Driver\GuzzleSoapClientDriver;
use eRecept\Environment;
use eRecept\UserPersonalData;

class FunctionTest extends \PHPUnit\Framework\TestCase
{

	/** @var \eRecept\Configuration */
	private $configuration;

	/** @var \eRecept\UserPersonalData */
	protected $userPersonalData;

	/** @var \eRecept\Cryptography\CryptographyService */
	private $crypt;

	public function setUp()
	{
		$neonConfig = Neon::decode(\file_get_contents(__DIR__ . '/../../erecept.neon'));

		$this->configuration = new Configuration(
			Environment::get(Environment::CUER_DOCTOR),
			'201704A',
			'0123456789AB',
			__DIR__ . $neonConfig['connection']['certificate'],
			$neonConfig['connection']['certificatePassword']
		);

		$this->userPersonalData = new UserPersonalData(
			__DIR__ . $neonConfig['user']['privateKey'],
			$neonConfig['user']['privateKeyPassword'],
			__DIR__ . $neonConfig['user']['certificate'],
			$neonConfig['user']['suklUid'],
			$neonConfig['user']['suklPassword']
		);

		$this->crypt = new CryptographyService($this->userPersonalData);

		parent::setUp();
	}

	public function testBase(): void
	{
		$this->assertEquals(
			'MTdiNWM4NjAtYjU3MC0xMWU3LWFiYzQtY2VjMjc4YjZiNTBhOlRlc3QxMjM0',
			\base64_encode(\sprintf('%s:%s', $this->userPersonalData->getUserUid(), $this->userPersonalData->getUserPassword()))
		);
	}

	protected function getClient(bool $signature = false): Client
	{
		$client = new Client(
			$this->configuration,
			new GuzzleSoapClientDriver(
				new \GuzzleHttp\Client(
					[
						\GuzzleHttp\RequestOptions::VERIFY => \Composer\CaBundle\CaBundle::getBundledCaBundlePath(),
						\GuzzleHttp\RequestOptions::CERT => [$this->configuration->getHttpsCertificate() , $this->configuration->getHttpsCertificatePassword()],
					]
				),
				'BASIC ' . \base64_encode(\sprintf('%s:%s', $this->userPersonalData->getUserUid(), $this->userPersonalData->getUserPassword()))
			),
			$this->crypt,
			$signature
		);

		return $client;
	}

}
