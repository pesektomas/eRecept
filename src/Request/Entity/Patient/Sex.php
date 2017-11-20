<?php declare(strict_types = 1);

namespace eRecept\Request\Entity\Patient;

class Sex extends \Consistence\Enum\Enum
{

	public const MALE = 'M';

	public const FEMALE = 'F';

	public const OTHER = 'O';

}
