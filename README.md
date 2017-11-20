# První nastavení pro testy

1. nahrát ssl certifikát do složky erecept/cert
2. nahrát privátní klíč a osobní certifikát do složky erecept/cert
3. zkopírovat erecept/tests/erecept.neon.example do erecept/tests/erecept.neon
4. nastavit proměnné v erecept/tests/erecept.neon

# Spustit docker a testy

1. cd /erecept
2. docker-compose up
3. docker exec -it php7.1_erecet bash
4. cd /srv
5. php vendor/bin/phing

# Konverze certifikátů

Sukl pošle soubor pfx, pro PHP ho musíme překonvertovat na PEM. Příkaz je následovný:

`openssl pkcs12 -in cuer_lekar.pfx -out cuer_lekar.pem -clcerts`

