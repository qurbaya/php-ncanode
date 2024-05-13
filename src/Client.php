<?php

declare(strict_types=1);

namespace Oibay\Ncanode;

use Oibay\Ncanode\Client\Client as HttpClient;
use Oibay\Ncanode\Client\Exceptions\HttpException;
use Oibay\Ncanode\Domains\PkcsInfo;
use Oibay\Ncanode\Domains\Verify;
use Oibay\Ncanode\Domains\X509Info;

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
    public function pkcsInfo(string $key, string $password, string $alies = null): mixed
    {
        return $this->execute(new PkcsInfo($key, $password, $alies));
    }


    /**
     * @throws HttpException
     */
    public function x509Info(string $certs): mixed
    {
        return $this->execute(new X509Info($certs));
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