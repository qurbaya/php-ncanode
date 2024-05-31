<?php

declare(strict_types=1);

namespace Oibay\Ncanode;

use DateTime;
use DomainException;
use Exception;
use Oibay\Ncanode\Client\Client as HttpClient;
use Oibay\Ncanode\Client\Exceptions\HttpException;
use Oibay\Ncanode\Domains\PkcsInfo;
use Oibay\Ncanode\Domains\Verify;
use Oibay\Ncanode\Domains\WsseSign;
use Oibay\Ncanode\Domains\X509Info;
use Oibay\Ncanode\Domains\XMLSign;

class NcanodeClient
{
    private string $url;

    public function __construct(string $url = 'http://127.0.0.1:14579/')
    {
        $this->url = $url;
    }

    /**
     * @param string $url
     * @deprecated use in contructor
     * @return void
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
    /**
     * @throws HttpException
     */
    public function verifyXML(string $xml): array
    {
        return $this->execute(new Verify($xml));
    }

    /**
     * @throws HttpException
     */
    public function pkcsInfo(string $key, string $password, string $alies = null): array
    {
        return $this->execute(new PkcsInfo($key, $password, $alies));
    }

    /**
     * @throws HttpException
     */
    public function xmlSign(
        string $xml,
        string $key,
        string $password,
        ?string $keyAlias = null,
        bool $clearSignatures = false,
        bool $trimXml = false
    ): array {
        return $this->execute(new XMLSign($xml, $key, $password, $keyAlias, $clearSignatures, $trimXml));
    }

    /**
     * @throws HttpException
     */
    public function wsseSign(
        string $xml,
        string $key,
        string $password,
        ?string $keyAlias = null,
        bool $trimXml = false
    ): array {
        return $this->execute(new WsseSign($xml, $key, $password, $keyAlias, $trimXml));
    }


    /**
     * @throws HttpException
     */
    public function x509Info(string $certs): array
    {
        return $this->execute(new X509Info($certs));
    }

    /**
     * @throws HttpException
     * @throws Exception
     */
    private function execute(object $data): array
    {
        $response =  (new HttpClient($this->url))->execute(
                    $data->getAction(),
                    $data->toArray()
                );

        if (!isset($response['signers'][0])) {
            throw new \InvalidArgumentException('Signers Not found');
        }

        $data = $response['signers'][0];

        $this->isValid($data['valid']);
        $this->isExpired($data['notBefore'], $data['notAfter']);

        return $response;
    }

    private function isValid(bool $value): void
    {
        if ($value === false) {
            throw new DomainException('Certificate is not valid');
        }
    }

    /**
     * @throws Exception
     */
    private function isExpired(string $startAt, string $endAt): void
    {
        $now = new DateTime();
        if ($now < new DateTime($startAt) || $now > new DateTime($endAt)) {
            throw new DomainException("Current date is outside the valid range.");
        }
    }
}
