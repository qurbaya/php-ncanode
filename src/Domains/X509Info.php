<?php

declare(strict_types=1);

namespace Oibay\Ncanode\Domains;

use Oibay\Ncanode\Domains\Constants\Action;
use Oibay\Ncanode\Domains\Contracts\DomainInterface;
use Webmozart\Assert\Assert;

class X509Info implements DomainInterface
{
    private string $certs;

    public function __construct(string $certs)
    {
        Assert::notEmpty($certs);
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
            'certs' => [
                $this->certs
            ]
        ];
    }
}
