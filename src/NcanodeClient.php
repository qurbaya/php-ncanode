<?php

declare(strict_types=1);

namespace Oibay\Ncanode;

use Oibay\Ncanode\Client\Client as HttpClient;
use Oibay\Ncanode\Client\Exceptions\HttpException;
use Oibay\Ncanode\Domains\PkcsInfo;
use Oibay\Ncanode\Domains\Verify;
use Oibay\Ncanode\Domains\X509Info;

class NcanodeClient
{

    private string $url = 'http://127.0.0.1:14579/';

    /**
     * @param string $url Default URL: http://127.0.0.1:14579/
     * @return void
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
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
        return (new HttpClient($this->url))->execute(
                    $data->getAction(),
                    $data->toArray()
                );
    }
}