<?php declare(strict_types = 1);

namespace eRecept\Request\Entity\Patient;

class Notification extends \Consistence\Enum\Enum
{

	public const SMS = 'SMS';

	public const EMAIL = 'EMAIL';

}
