<?php declare(strict_types = 1);

namespace eRecept\Request;

use eRecept\Method;

interface Request
{

	/**
	 * @return mixed[]
	 */
	public function getData(): array;

	public function getMethod(): Method;

}
