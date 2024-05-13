<?php

namespace Oibay\Ncanode;
use Oibay\Ncanode\Client\Client as HttpClient;
use Oibay\Ncanode\Client\Exceptions\HttpException;
use Oibay\Ncanode\Domains\Info;
use Oibay\Ncanode\Domains\Verify;

class Client
{

    /**
     * @throws HttpException
     */
    public function verifyXML(string $xml): mixed
    {
        return $this->execute(new Verify($xml));
    }

    /**
     * @throws HttpException
     */
    public function info(string $key, string $password, string $alies = null): mixed
    {
        return $this->execute(new Info($key, $password, $alies));
    }

    /**
     * @throws HttpException
     */
    private function execute(object $data): mixed
    {
        return (new HttpClient())->execute(
                    $data->getAction(),
                    $data->toArray()
                );
    }
}