<?php declare(strict_types = 1);

namespace eRecept\Response;

use eRecept\Exception\ClassNotFoundException;
use eRecept\Exception\ClassNotImplementedInterface;
use eRecept\Method;

class ResponseLoader
{

	public static function loadResponse(Method $method): Response
	{
		$classObject = \sprintf('eRecept\\Response\\%sResponse', $method->getValue());

		if (\class_exists($classObject)) {
			$class = new $classObject();
			if ($class instanceof Response) {
				return $class;
			} else {
				throw new ClassNotImplementedInterface($classObject, Response::class);
			}
		} else {
			throw new ClassNotFoundException($classObject);
		}
	}

}
