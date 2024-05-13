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

``` 
<?php

use Oibay\Ncanode\NcanodeClient;

$client = new NcanodeClient();

$client->setUrl(); //По умолчанию http://localhost:14579/

$client->x509Info(base64_encode('<root></root>'));

$client->pkcsInfo(base64_encode('<root></root>'),'123');

$client->verifyXML('<root></root>');
```
