<?php declare(strict_types = 1);

namespace eRecept;

use eRecept\FunctionTest\FunctionTest;
use eRecept\Request\AppPingRequest;
use eRecept\Request\Entity\AppPing;
use eRecept\Request\Entity\Message;
use eRecept\Request\Request;

class AppPingClientTest extends FunctionTest
{

	/** @var  \eRecept\Client|\PHPUnit_Framework_MockObject_MockObject */
	private $client;

	/** @var  \eRecept\SoapClient|\PHPUnit_Framework_MockObject_MockObject */
	private $soapClient;

	public function setUp()
	{
		parent::setUp();
		$this->client = $this->getClient();

		$soapClient = $this->createMock(SoapClient::class);
		(function () use ($soapClient) {
			$this->soapClient = $soapClient;
		})->call($this->client);
		$this->soapClient = $soapClient;
	}

	public function testSuccess()
	{
		$method = Method::get(Method::METHOD_APP_PING);

		$request = $this->getRequest();

		$this->soapClient->expects($this->once())
			->method('sendRequest')
			->with(
				$this->isInstanceOf(Method::class),
				$this->callback(function (array $request) {
					$this->assertArrayHasKey('AppPingDotaz', $request);
					$this->assertArrayHasKey('Zprava', $request['AppPingDotaz']);
					$this->assertArrayHasKey('ID_Zpravy', $request['AppPingDotaz']['Zprava']);
					$this->assertArrayHasKey('Verze', $request['AppPingDotaz']['Zprava']);
					$this->assertArrayHasKey('Odeslano', $request['AppPingDotaz']['Zprava']);
					return true;
				})
			)
			->willReturn($this->getResponseData());

		$response = $this->client->send($request);
		$this->assertTrue($response->isValid());
	}

	public function testInvalid()
	{
		$method = Method::get(Method::METHOD_APP_PING);

		$request = $this->getRequest();

		$this->soapClient->expects($this->once())
			->method('sendRequest')
			->with(
				$this->isInstanceOf(Method::class),
				$this->callback(function (array $request) {
					$this->assertArrayHasKey('AppPingDotaz', $request);
					$this->assertArrayHasKey('Zprava', $request['AppPingDotaz']);
					$this->assertArrayHasKey('ID_Zpravy', $request['AppPingDotaz']['Zprava']);
					$this->assertArrayHasKey('Verze', $request['AppPingDotaz']['Zprava']);
					$this->assertArrayHasKey('Odeslano', $request['AppPingDotaz']['Zprava']);
					return true;
				})
			)
			->willReturn($this->getResponseData());

		try {
			$this->client->send($request);
			$this->fail('test');
		} catch (\Throwable $e) {
			$this->assertTrue(true);
		}
	}

	private function getResponseData(): \stdClass
	{
		return (object) [
			'AppPingZEPOdpoved' => (object) [
				'Zprava' => (object) [
					'ID_Zpravy' => '123',
					'Verze' => '123',
					'Odeslano' => '2017-10-05T14:46:12+02:00',
					'ID_Podani' => '123',
					'Prijato' => '2017-10-05T14:46:15+02:00',
				],
			],
		];
	}

	private function getRequest(): Request
	{
		$appPing = new AppPing(
			new Message(
				EreceptVersion::get(EreceptVersion::V_201704A),
				new \DateTimeImmutable('2017-10-05 14:46:12', new \DateTimeZone('Europe/Prague')),
				'123'
			)
		);
		return new AppPingRequest($appPing);
	}

}
