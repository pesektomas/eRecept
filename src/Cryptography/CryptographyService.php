<?php declare(strict_types = 1);

namespace eRecept\Cryptography;

use DOMDocument;
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;
use eRecept\UserPersonalData;

class CryptographyService
{

	/** @var \eRecept\UserPersonalData */
	private $userPersonalData;

	public function __construct(UserPersonalData $userPersonalData)
	{
		$this->userPersonalData = $userPersonalData;
	}

	public function addWSESignature(DOMDocument $document): string
	{
		$objDSig = new XMLSecurityDSig();
		$objDSig->add509Cert($this->userPersonalData->getCertificate(), true, true);
		$objDSig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
		$objDSig->addReference(
			$document,
			XMLSecurityDSig::SHA256,
			['http://www.w3.org/2000/09/xmldsig#enveloped-signature'],
			['force_uri' => true]
		);

		$objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, ['type' => 'private']);
		$objKey->passphrase = $this->userPersonalData->getPrivateKeyPassword();
		$objKey->loadKey($this->userPersonalData->getPrivateKey(), true);

		$objDSig->sign($objKey);

		$objDSig->appendSignature($document->firstChild);

		return $document->saveXML();
	}

}
