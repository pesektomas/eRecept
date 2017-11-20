<?php declare(strict_types = 1);

namespace eRecept\Request;

interface Request
{

	/**
	 * @return mixed[]
	 */
	public function getData(): array;

}
