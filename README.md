### Установка
```
composer require oibay/ncanode_client
```


### Методы
    verifyXML - Проверяет все подписи в XML
    pkcsInfo  - Возвращает информацию о ключе, его владельце и т.д.
    x509Info  - Возвращает информацию о сертификате


### Подробно [ncanode.kz](https://ncanode.kz/).

### Пример

``` php
<?php

use Oibay\Ncanode\NcanodeClient;

$client = new NcanodeClient();

$client->setUrl(); //По умолчанию http://localhost:14579/

$client->x509Info(base64_encode('key'));

$client->pkcsInfo(base64_encode('key'),'123');

$client->verifyXML('xml');

$client->xmlSign('<root></root>',base64_encode('123'),'123')
```
