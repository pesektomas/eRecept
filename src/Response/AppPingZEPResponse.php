<?php declare(strict_types = 1);

namespace eRecept\Response;

class AppPingZEPResponse implements Response
{

	public function parse(\stdClass $soapResponse): void
	{
	}

	public function isValid(): bool
	{
		return true;
	}

}
