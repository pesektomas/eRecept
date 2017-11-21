# Instalace

```
> composer require pesovo/erecept
```

# Použití

```php
$configuration = new Configuration(
	Environment::get(Environment::CUER_DOCTOR),
	EreceptVersion::get(EreceptVersion::V_201704A),
	'1234567890',
	'cesta k ssl certifikatu',
	'heslo k ssl certifikatu'
);

$userPersonalData = new UserPersonalData(
	'cesta k privatnimu klici',
	'heslo k privatnimu klici',
	'cesta k uzivatelskemu certfikatu',
	'SUKL uzivatelske uid',
	'SUKL uzivatelske heslo'
);

$client = new Client(
	$configuration,
	new GuzzleSoapClientDriver(
		new \GuzzleHttp\Client(
			[
				\GuzzleHttp\RequestOptions::VERIFY => \Composer\CaBundle\CaBundle::getBundledCaBundlePath(),
				\GuzzleHttp\RequestOptions::CERT => [$configuration->getHttpsCertificate() , $configuration->getHttpsCertificatePassword()],
			]
		),
		'BASIC ' . \base64_encode(\sprintf('%s:%s', $userPersonalData->getUserUid(), $userPersonalData->getUserPassword()))
	),
	new CryptographyService($userPersonalData),
	true
);

$appPingZep = new AppPingZEP(
	new Message(
		$configuration->getVersion(),
		new \DateTimeImmutable('now', new \DateTimeZone('Europe/Prague')),
		'0123456789AB'
	)
);

try {
	$response = $client->send(new AppPingZepRequest($appPingZep));
	print_r($response);
} catch (\Throwable $th) {
	echo 'error ' . $th->getMessage() . PHP_EOL;
}
```

# První nastavení pro testy

1. nahrát ssl certifikát do složky erecept/cert
2. nahrát privátní klíč a osobní certifikát do složky erecept/cert
3. zkopírovat erecept/tests/erecept.neon.example do erecept/tests/erecept.neon
4. nastavit proměnné v erecept/tests/erecept.neon

# Spustit docker a testy

```
> cd /erecept
> docker-compose up -d
> docker exec -it php7.1_erecet bash
> cd /srv
> php vendor/bin/phing
```

# Konverze certifikátů

Sukl pošle soubor pfx, pro PHP ho musíme překonvertovat na PEM. Příkaz je následovný:

``` > openssl pkcs12 -in cuer_lekar.pfx -out cuer_lekar.pem -clcerts```

# Přehled metod a jejich implementace

| Metoda                            | Určení   | Implementace |
|-----------------------------------|----------|--------------|
| AppPing                           | Všichni  | ANO          |
| AppPingZEP                        | Všichni  | ANO          |
| NacistCiselnikChyb                | Všichni  | ANO          |
| NacistVerze                       | Všichni  | ANO          |
| ZalozitPredpis                    | Lékař    | ANO          |
| ZmenitPredpis                     | Lékař    | ANO          |
| ZrusitPredpis                     | Lékař    | ANO          |
| NacistInformaceOZrusenemPredpisu  | Lékař    | NE           |
| NacistPredpis                     | Všichni  | NE           |
| StahnoutPruvodku                  | Všichni  | NE           |
| ZalozitVydej                      | Lékárník | NE           |
| ZmenitVydej                       | Lékárník | NE           |
| ZrusitVydej                       | Lékárník | NE           |
| NacistInformaceOZrusenemVydeji    | Všichni  | NE           |
| NacistVydej                       | Všichni  | NE           |
| ZmenitStavPredpisu                | Lékárník | NE           |
| DigitalizovatPredpis              | Lékárník | NE           |
| ZmenitPojistovnuPredpisu          | Lékárník | NE           |
| SeznamPredpisu                    | Lékař    | NE           |
| SeznamVydejuPredepisujiciho       | Lékař    | NE           |
| PripravitVydejePredepisujiciho    | Lékař    | NE           |
| StahnoutVydejePredepisujiciho     | Lékař    | NE           |
| PrevzitVydejePredepisujiciho      | Lékař    | NE           |
| OveritPredpis                     | Lékař    | NE           |
| OveritVydej                       | Lékárník | NE           |
| ZalozitVydejOTC                   | Lékárník | NE           |
| ZmenitVydejOTC                    | Lékárník | NE           |
| ZrusitVydejOTC                    | Lékárník | NE           |
| NacistVydejOTC                    | Lékárník | NE           |
| NacistInformaceOZrusenemVydejiOTC | Lékárník | NE           |
