<?php declare(strict_types = 1);

namespace eRecept;

class Formatter
{

	public static function formatDateTime(\DateTimeImmutable $value): string
	{
		return $value->format('c');
	}

	public static function formatDate(\DateTimeImmutable $value): string
	{
		return $value->format('Y-m-d');
	}

}
