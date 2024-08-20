### Установка
```
composer require oibay/ncanode_client
```


### Методы
    verifyXML - Проверяет все подписи в XML
    pkcsInfo  - Возвращает информацию о ключе, его владельце и т.д.
    x509Info  - Возвращает информацию о сертификате


### Подробно [ncanode.kz](https://ncanode.kz/).

### Методы

``` php
<?php

use Oibay\Ncanode\NcanodeClient;

$client = new NcanodeClient();

$client->setUrl(); //По умолчанию http://localhost:14579/ 

$client->x509Info();

$client->pkcsInfo();

$client->verifyXML();

$client->xmlSign();

$client->wsseSign();
$client->cmsSign();
```
