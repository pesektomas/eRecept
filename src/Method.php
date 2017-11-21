<?php declare(strict_types = 1);

namespace eRecept;

class Method extends \Consistence\Enum\Enum
{

	public const METHOD_APP_PING = 'AppPing';

	public const METHOD_APP_PING_ZEP = 'AppPingZEP';

	public const METHOD_LOAD_ERRORS = 'NacistCiselnikChyb';

	public const METHOD_LOAD_VERSIONS = 'NacistVerze';

	public const METHOD_CREATE_PRESCRIPTION = 'ZalozitPredpis';

	public const METHOD_UPDATE_PRESCRIPTION = 'ZmenitPredpis';

	public const METHOD_CANCEL_PRESCRIPTION = 'ZrusitPredpis';

}
