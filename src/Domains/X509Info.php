<?php

namespace Oibay\Ncanode\Domains;

use Oibay\Ncanode\Domains\Constants\Action;
use Oibay\Ncanode\Domains\Contracts\DomainInterface;

class X509Info implements DomainInterface
{
    private string $certs;

    /**
     * @param string $certs The certs in Base64 format.
     */
    public function __construct(string $certs)
    {
        $this->certs = $certs;
    }


    public function getAction(): string
    {
        return Action::X509_INFO;
    }

    public function toArray(): array
    {
        return [
            'revocationCheck' => [
                'OCSP'
            ],
            'certs' => $this->certs
        ];
    }
}