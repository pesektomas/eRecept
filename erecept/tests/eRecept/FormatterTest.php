<?php declare(strict_types = 1);

namespace eRecept;

class FormatterTest extends \PHPUnit\Framework\TestCase
{

	/**
	 * @dataProvider dataTestFormatDateTime
	 * @param \DateTimeImmutable $value
	 * @param string $expected
	 */
	public function testFormatDateTime(\DateTimeImmutable $value, string $expected)
	{
		$this->assertSame($expected, Formatter::formatDateTime($value));
	}

	/**
	 * @return mixed[][]
	 */
	public function dataTestFormatDateTime(): array
	{
		return [
			[new \DateTimeImmutable('2016-03-11 11:05:00', new \DateTimeZone('Europe/Prague')), '2016-03-11T11:05:00+01:00'],
			[new \DateTimeImmutable('2016-08-11 11:05:00', new \DateTimeZone('Europe/Prague')), '2016-08-11T11:05:00+02:00'],
		];
	}

}
