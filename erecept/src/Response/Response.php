<?php declare(strict_types = 1);

namespace eRecept\Response;

interface Response
{

	public function parse(\stdClass $soapResponse): void;

	public function isValid(): bool;

}
