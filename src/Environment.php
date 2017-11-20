<?php declare(strict_types = 1);

namespace eRecept;

class Environment extends \Consistence\Enum\Enum
{

	public const CUER_DOCTOR = 'CUERLekar';
	public const CUER_PHARMACIST = 'CUERLekarnik';
	public const CUER_PATIENT = 'CUERPacient';
	public const CUER_INSURANCE_EMPLOYER = 'CUERPracovnikZP';

	public const RLPO_DOCTOR = 'RLPOLekar';
	public const RLPO_PHARMACIST = 'RLPOLekarnik';

	public function getWsdlPath(): string
	{
		return \sprintf('%s/../wsdl/%s.wsdl', __DIR__, self::getValue());
	}

}
